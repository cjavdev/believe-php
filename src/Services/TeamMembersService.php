<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\RequestOptions;
use Believe\ServiceContracts\TeamMembersContract;
use Believe\SkipLimitPage;
use Believe\TeamMembers\Coach;
use Believe\TeamMembers\CoachSpecialty;
use Believe\TeamMembers\EquipmentManager;
use Believe\TeamMembers\MedicalStaff;
use Believe\TeamMembers\Player;
use Believe\TeamMembers\Position;
use Believe\TeamMembers\TeamMemberCreateParams\Member\CoachBase;
use Believe\TeamMembers\TeamMemberCreateParams\Member\EquipmentManagerBase;
use Believe\TeamMembers\TeamMemberCreateParams\Member\MedicalStaffBase;
use Believe\TeamMembers\TeamMemberCreateParams\Member\PlayerBase;
use Believe\TeamMembers\TeamMemberListParams\MemberType;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\CoachUpdate;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\EquipmentManagerUpdate;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\MedicalStaffUpdate;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\PlayerUpdate;

/**
 * @phpstan-import-type MemberShape from \Believe\TeamMembers\TeamMemberCreateParams\Member
 * @phpstan-import-type UpdatesShape from \Believe\TeamMembers\TeamMemberUpdateParams\Updates
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class TeamMembersService implements TeamMembersContract
{
    /**
     * @api
     */
    public TeamMembersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TeamMembersRawService($client);
    }

    /**
     * @api
     *
     * Add a new team member to a team.
     *
     * The request body is a **union type (oneOf)** - you must include the `member_type` discriminator field:
     * - `"member_type": "player"` - Creates a player (requires position, jersey_number, etc.)
     * - `"member_type": "coach"` - Creates a coach (requires specialty, etc.)
     * - `"member_type": "medical_staff"` - Creates medical staff (requires medical specialty, etc.)
     * - `"member_type": "equipment_manager"` - Creates equipment manager (requires responsibilities, etc.)
     *
     * The `character_id` field references an existing character from `/characters/{id}`.
     *
     * **Example for creating a player:**
     * ```json
     * {
     *   "member_type": "player",
     *   "character_id": "sam-obisanya",
     *   "team_id": "afc-richmond",
     *   "years_with_team": 2,
     *   "position": "midfielder",
     *   "jersey_number": 24,
     *   "goals_scored": 12,
     *   "assists": 15
     * }
     * ```
     *
     * @param MemberShape $member a football player on the team
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        PlayerBase|array|CoachBase|MedicalStaffBase|EquipmentManagerBase $member,
        RequestOptions|array|null $requestOptions = null,
    ): Player|Coach|MedicalStaff|EquipmentManager {
        $params = Util::removeNulls(['member' => $member]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve detailed information about a specific team member.
     *
     * The response is a **union type (oneOf)** - the actual shape depends on the member's type:
     * - **player**: Includes position, jersey_number, goals_scored, assists, is_captain
     * - **coach**: Includes specialty, certifications, win_rate
     * - **medical_staff**: Includes specialty, qualifications, license_number
     * - **equipment_manager**: Includes responsibilities, is_head_kitman
     *
     * Use `character_id` to fetch full character details from `/characters/{character_id}`.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $memberID,
        RequestOptions|array|null $requestOptions = null
    ): Player|Coach|MedicalStaff|EquipmentManager {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($memberID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update specific fields of an existing team member. Fields vary by member type.
     *
     * @param UpdatesShape $updates update model for players
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $memberID,
        PlayerUpdate|array|CoachUpdate|MedicalStaffUpdate|EquipmentManagerUpdate $updates,
        RequestOptions|array|null $requestOptions = null,
    ): Player|Coach|MedicalStaff|EquipmentManager {
        $params = Util::removeNulls(['updates' => $updates]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($memberID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a paginated list of all team members.
     *
     * This endpoint demonstrates **union types (oneOf)** in the response.
     * Each team member can be one of: Player, Coach, MedicalStaff, or EquipmentManager.
     * The `member_type` field acts as a discriminator to determine the shape of each object.
     *
     * @param int $limit Maximum number of items to return (max: 100)
     * @param MemberType|value-of<MemberType>|null $memberType Filter by member type
     * @param int $skip Number of items to skip (offset)
     * @param string|null $teamID Filter by team ID
     * @param RequestOpts|null $requestOptions
     *
     * @return SkipLimitPage<Player|Coach|MedicalStaff|EquipmentManager>
     *
     * @throws APIException
     */
    public function list(
        int $limit = 20,
        MemberType|string|null $memberType = null,
        int $skip = 0,
        ?string $teamID = null,
        RequestOptions|array|null $requestOptions = null,
    ): SkipLimitPage {
        $params = Util::removeNulls(
            [
                'limit' => $limit,
                'memberType' => $memberType,
                'skip' => $skip,
                'teamID' => $teamID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Remove a team member from the roster.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $memberID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($memberID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get only coaches (filtered subset of team members).
     *
     * @param int $limit Maximum number of items to return (max: 100)
     * @param int $skip Number of items to skip (offset)
     * @param CoachSpecialty|value-of<CoachSpecialty>|null $specialty Filter by specialty
     * @param string|null $teamID Filter by team ID
     * @param RequestOpts|null $requestOptions
     *
     * @return SkipLimitPage<Coach>
     *
     * @throws APIException
     */
    public function listCoaches(
        int $limit = 20,
        int $skip = 0,
        CoachSpecialty|string|null $specialty = null,
        ?string $teamID = null,
        RequestOptions|array|null $requestOptions = null,
    ): SkipLimitPage {
        $params = Util::removeNulls(
            [
                'limit' => $limit,
                'skip' => $skip,
                'specialty' => $specialty,
                'teamID' => $teamID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listCoaches(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get only players (filtered subset of team members).
     *
     * @param int $limit Maximum number of items to return (max: 100)
     * @param Position|value-of<Position>|null $position Filter by position
     * @param int $skip Number of items to skip (offset)
     * @param string|null $teamID Filter by team ID
     * @param RequestOpts|null $requestOptions
     *
     * @return SkipLimitPage<Player>
     *
     * @throws APIException
     */
    public function listPlayers(
        int $limit = 20,
        Position|string|null $position = null,
        int $skip = 0,
        ?string $teamID = null,
        RequestOptions|array|null $requestOptions = null,
    ): SkipLimitPage {
        $params = Util::removeNulls(
            [
                'limit' => $limit,
                'position' => $position,
                'skip' => $skip,
                'teamID' => $teamID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listPlayers(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get all staff members (medical staff and equipment managers).
     *
     * This demonstrates a **narrower union type** - the response is oneOf MedicalStaff or EquipmentManager.
     *
     * @param int $limit Maximum number of items to return (max: 100)
     * @param int $skip Number of items to skip (offset)
     * @param string|null $teamID Filter by team ID
     * @param RequestOpts|null $requestOptions
     *
     * @return SkipLimitPage<MedicalStaff|EquipmentManager>
     *
     * @throws APIException
     */
    public function listStaff(
        int $limit = 20,
        int $skip = 0,
        ?string $teamID = null,
        RequestOptions|array|null $requestOptions = null,
    ): SkipLimitPage {
        $params = Util::removeNulls(
            ['limit' => $limit, 'skip' => $skip, 'teamID' => $teamID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listStaff(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

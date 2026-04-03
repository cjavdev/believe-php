<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Client;
use Believe\Core\Util;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\TeamMembersRawContract;
use Believe\TeamMembers\TeamMemberNewResponse;
use Believe\TeamMembers\TeamMemberGetResponse;
use Believe\TeamMembers\TeamMemberUpdateResponse;
use Believe\TeamMembers\TeamMemberListResponse;
use Believe\TeamMembers\CoachSpecialty;
use Believe\TeamMembers\TeamMemberListStaffResponse;
use Believe\TeamMembers\TeamMemberCreateParams;
use Believe\TeamMembers\Player;
use Believe\TeamMembers\Coach;
use Believe\TeamMembers\MedicalStaff;
use Believe\TeamMembers\EquipmentManager;
use Believe\TeamMembers\TeamMemberUpdateParams;
use Believe\TeamMembers\TeamMemberListParams;
use Believe\TeamMembers\TeamMemberListCoachesParams;
use Believe\TeamMembers\Position;
use Believe\TeamMembers\TeamMemberListPlayersParams;
use Believe\TeamMembers\TeamMemberListStaffParams;
use Believe\TeamMembers\TeamMemberListParams\MemberType;

/**
  * Team members with union types (oneOf) - Players, Coaches, Medical Staff, Equipment Managers
  * @phpstan-import-type MemberShape from \Believe\TeamMembers\TeamMemberCreateParams\Member
  * @phpstan-import-type UpdatesShape from \Believe\TeamMembers\TeamMemberUpdateParams\Updates
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class TeamMembersRawService implements TeamMembersRawContract
{
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
  * @param array{member: MemberShape}|TeamMemberCreateParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Player|Coach|MedicalStaff|EquipmentManager>
  *
  * @throws APIException
 */
  public function create(
    array|TeamMemberCreateParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = TeamMemberCreateParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'post',
      path: 'team-members',
      body: (object) $parsed['member'],
      options: $options,
      convert: TeamMemberNewResponse::class,
    );
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
  * @param string $memberID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Player|Coach|MedicalStaff|EquipmentManager>
  *
  * @throws APIException
 */
  public function retrieve(
    string $memberID, null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: ['team-members/%1$s', $memberID],
      options: $requestOptions,
      convert: TeamMemberGetResponse::class,
    );
  }

  /**
  * @api
  *
  * Update specific fields of an existing team member. Fields vary by member type.
  *
  * @param string $memberID
  * @param array{updates: UpdatesShape}|TeamMemberUpdateParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Player|Coach|MedicalStaff|EquipmentManager>
  *
  * @throws APIException
 */
  public function update(
    string $memberID,
    array|TeamMemberUpdateParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = TeamMemberUpdateParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'patch',
      path: ['team-members/%1$s', $memberID],
      body: (object) $parsed['updates'],
      options: $options,
      convert: TeamMemberUpdateResponse::class,
    );
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
  * @param array{
  *   limit?: int,
  *   memberType?: null|MemberType|value-of<MemberType>,
  *   skip?: int,
  *   teamID?: string|null,
  * }|TeamMemberListParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<SkipLimitPage<Player|Coach|MedicalStaff|EquipmentManager>>
  *
  * @throws APIException
 */
  public function list(
    array|TeamMemberListParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = TeamMemberListParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: 'team-members',
      query: Util::array_transform_keys(
        $parsed, ['memberType' => 'member_type', 'teamID' => 'team_id']
      ),
      options: $options,
      convert: TeamMemberListResponse::class,
      page: SkipLimitPage::class,
    );
  }

  /**
  * @api
  *
  * Remove a team member from the roster.
  *
  * @param string $memberID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
  public function delete(
    string $memberID, null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'delete',
      path: ['team-members/%1$s', $memberID],
      options: $requestOptions,
      convert: null,
    );
  }

  /**
  * @api
  *
  * Get only coaches (filtered subset of team members).
  *
  * @param array{
  *   limit?: int,
  *   skip?: int,
  *   specialty?: value-of<CoachSpecialty>,
  *   teamID?: string|null,
  * }|TeamMemberListCoachesParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<SkipLimitPage<Coach>>
  *
  * @throws APIException
 */
  public function listCoaches(
    array|TeamMemberListCoachesParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = TeamMemberListCoachesParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: 'team-members/coaches/',
      query: Util::array_transform_keys($parsed, ['teamID' => 'team_id']),
      options: $options,
      convert: Coach::class,
      page: SkipLimitPage::class,
    );
  }

  /**
  * @api
  *
  * Get only players (filtered subset of team members).
  *
  * @param array{
  *   limit?: int,
  *   position?: null|Position|value-of<Position>,
  *   skip?: int,
  *   teamID?: string|null,
  * }|TeamMemberListPlayersParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<SkipLimitPage<Player>>
  *
  * @throws APIException
 */
  public function listPlayers(
    array|TeamMemberListPlayersParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = TeamMemberListPlayersParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: 'team-members/players/',
      query: Util::array_transform_keys($parsed, ['teamID' => 'team_id']),
      options: $options,
      convert: Player::class,
      page: SkipLimitPage::class,
    );
  }

  /**
  * @api
  *
  * Get all staff members (medical staff and equipment managers).
  *
  * This demonstrates a **narrower union type** - the response is oneOf MedicalStaff or EquipmentManager.
  *
  * @param array{
  *   limit?: int, skip?: int, teamID?: string|null
  * }|TeamMemberListStaffParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<SkipLimitPage<MedicalStaff|EquipmentManager>>
  *
  * @throws APIException
 */
  public function listStaff(
    array|TeamMemberListStaffParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = TeamMemberListStaffParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: 'team-members/staff/',
      query: Util::array_transform_keys($parsed, ['teamID' => 'team_id']),
      options: $options,
      convert: TeamMemberListStaffResponse::class,
      page: SkipLimitPage::class,
    );
  }

  // @phpstan-ignore-next-line
  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {}
}
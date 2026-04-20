<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
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
interface TeamMembersContract
{
    /**
     * @api
     *
     * @param MemberShape $member a football player on the team
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        PlayerBase|array|CoachBase|MedicalStaffBase|EquipmentManagerBase $member,
        RequestOptions|array|null $requestOptions = null,
    ): Player|Coach|MedicalStaff|EquipmentManager;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $memberID,
        RequestOptions|array|null $requestOptions = null
    ): Player|Coach|MedicalStaff|EquipmentManager;

    /**
     * @api
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
    ): Player|Coach|MedicalStaff|EquipmentManager;

    /**
     * @api
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
    ): SkipLimitPage;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $memberID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): SkipLimitPage;

    /**
     * @api
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
    ): SkipLimitPage;

    /**
     * @api
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
    ): SkipLimitPage;
}

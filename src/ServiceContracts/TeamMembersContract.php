<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Core\Exceptions\APIException;
use Believe\TeamMembers\Player;
use Believe\TeamMembers\Coach;
use Believe\TeamMembers\MedicalStaff;
use Believe\TeamMembers\EquipmentManager;
use Believe\TeamMembers\CoachSpecialty;
use Believe\TeamMembers\Position;
use Believe\TeamMembers\TeamMemberCreateParams\Member\PlayerBase;
use Believe\TeamMembers\TeamMemberCreateParams\Member\CoachBase;
use Believe\TeamMembers\TeamMemberCreateParams\Member\MedicalStaffBase;
use Believe\TeamMembers\TeamMemberCreateParams\Member\EquipmentManagerBase;
use Believe\TeamMembers\TeamMemberListParams\MemberType;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\PlayerUpdate;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\CoachUpdate;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\MedicalStaffUpdate;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\EquipmentManagerUpdate;

/**
  * @phpstan-import-type MemberShape from \Believe\TeamMembers\TeamMemberCreateParams\Member
  * @phpstan-import-type UpdatesShape from \Believe\TeamMembers\TeamMemberUpdateParams\Updates
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface TeamMembersContract{

    /**
  * @api
  *
  * @param MemberShape $member A football player on the team.
  * @param RequestOpts|null $requestOptions
  *
  * @return Player|Coach|MedicalStaff|EquipmentManager
  *
  * @throws APIException
 */
    public function create(
      PlayerBase|array|CoachBase|MedicalStaffBase|EquipmentManagerBase $member,
      null|RequestOptions|array $requestOptions = null,
    ): Player|Coach|MedicalStaff|EquipmentManager;

    /**
  * @api
  *
  * @param string $memberID
  * @param RequestOpts|null $requestOptions
  *
  * @return Player|Coach|MedicalStaff|EquipmentManager
  *
  * @throws APIException
 */
    public function retrieve(
      string $memberID, null|RequestOptions|array $requestOptions = null
    ): Player|Coach|MedicalStaff|EquipmentManager;

    /**
  * @api
  *
  * @param string $memberID
  * @param UpdatesShape $updates Update model for players.
  * @param RequestOpts|null $requestOptions
  *
  * @return Player|Coach|MedicalStaff|EquipmentManager
  *
  * @throws APIException
 */
    public function update(
      string $memberID,
      PlayerUpdate|array|CoachUpdate|MedicalStaffUpdate|EquipmentManagerUpdate $updates,
      null|RequestOptions|array $requestOptions = null,
    ): Player|Coach|MedicalStaff|EquipmentManager;

    /**
  * @api
  *
  * @param int $limit Maximum number of items to return (max: 100)
  * @param null|MemberType|value-of<MemberType> $memberType Filter by member type
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
      null|MemberType|string $memberType = null,
      int $skip = 0,
      ?string $teamID = null,
      null|RequestOptions|array $requestOptions = null,
    ): SkipLimitPage;

    /**
  * @api
  *
  * @param string $memberID
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
    public function delete(
      string $memberID, null|RequestOptions|array $requestOptions = null
    ): mixed;

    /**
  * @api
  *
  * @param int $limit Maximum number of items to return (max: 100)
  * @param int $skip Number of items to skip (offset)
  * @param null|CoachSpecialty|value-of<CoachSpecialty> $specialty Filter by specialty
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
      null|CoachSpecialty|string $specialty = null,
      ?string $teamID = null,
      null|RequestOptions|array $requestOptions = null,
    ): SkipLimitPage;

    /**
  * @api
  *
  * @param int $limit Maximum number of items to return (max: 100)
  * @param null|Position|value-of<Position> $position Filter by position
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
      null|Position|string $position = null,
      int $skip = 0,
      ?string $teamID = null,
      null|RequestOptions|array $requestOptions = null,
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
      null|RequestOptions|array $requestOptions = null,
    ): SkipLimitPage;

}
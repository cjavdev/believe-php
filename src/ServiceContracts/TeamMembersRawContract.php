<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\TeamMembers\TeamMemberCreateParams;
use Believe\TeamMembers\Player;
use Believe\TeamMembers\Coach;
use Believe\TeamMembers\MedicalStaff;
use Believe\TeamMembers\EquipmentManager;
use Believe\TeamMembers\TeamMemberUpdateParams;
use Believe\TeamMembers\TeamMemberListParams;
use Believe\TeamMembers\TeamMemberListCoachesParams;
use Believe\TeamMembers\TeamMemberListPlayersParams;
use Believe\TeamMembers\TeamMemberListStaffParams;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface TeamMembersRawContract{

    /**
  * @api
  *
  * @param array<string,mixed>|TeamMemberCreateParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Player|Coach|MedicalStaff|EquipmentManager>
  *
  * @throws APIException
 */
    public function create(
      array|TeamMemberCreateParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
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
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $memberID
  * @param array<string,mixed>|TeamMemberUpdateParams $params
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
    ): BaseResponse;

    /**
  * @api
  *
  * @param array<string,mixed>|TeamMemberListParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<SkipLimitPage<Player|Coach|MedicalStaff|EquipmentManager>>
  *
  * @throws APIException
 */
    public function list(
      array|TeamMemberListParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
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
    ): BaseResponse;

    /**
  * @api
  *
  * @param array<string,mixed>|TeamMemberListCoachesParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<SkipLimitPage<Coach>>
  *
  * @throws APIException
 */
    public function listCoaches(
      array|TeamMemberListCoachesParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param array<string,mixed>|TeamMemberListPlayersParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<SkipLimitPage<Player>>
  *
  * @throws APIException
 */
    public function listPlayers(
      array|TeamMemberListPlayersParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param array<string,mixed>|TeamMemberListStaffParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<SkipLimitPage<MedicalStaff|EquipmentManager>>
  *
  * @throws APIException
 */
    public function listStaff(
      array|TeamMemberListStaffParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

}
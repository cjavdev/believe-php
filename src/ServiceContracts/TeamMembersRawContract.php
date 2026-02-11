<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\TeamMembers\Coach;
use Believe\TeamMembers\EquipmentManager;
use Believe\TeamMembers\MedicalStaff;
use Believe\TeamMembers\Player;
use Believe\TeamMembers\TeamMemberCreateParams;
use Believe\TeamMembers\TeamMemberListCoachesParams;
use Believe\TeamMembers\TeamMemberListParams;
use Believe\TeamMembers\TeamMemberListPlayersParams;
use Believe\TeamMembers\TeamMemberListStaffParams;
use Believe\TeamMembers\TeamMemberUpdateParams;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface TeamMembersRawContract
{
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
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Player|Coach|MedicalStaff|EquipmentManager>
     *
     * @throws APIException
     */
    public function retrieve(
        string $memberID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
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
        RequestOptions|array|null $requestOptions = null,
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
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $memberID,
        RequestOptions|array|null $requestOptions = null
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
        RequestOptions|array|null $requestOptions = null,
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
        RequestOptions|array|null $requestOptions = null,
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
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

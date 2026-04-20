<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Teams\Logo\FileUpload;
use Believe\Teams\Team;
use Believe\Teams\TeamCreateParams;
use Believe\Teams\TeamListParams;
use Believe\Teams\TeamUpdateParams;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface TeamsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|TeamCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Team>
     *
     * @throws APIException
     */
    public function create(
        array|TeamCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Team>
     *
     * @throws APIException
     */
    public function retrieve(
        string $teamID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TeamUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Team>
     *
     * @throws APIException
     */
    public function update(
        string $teamID,
        array|TeamUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TeamListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<Team>>
     *
     * @throws APIException
     */
    public function list(
        array|TeamListParams $params,
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
        string $teamID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<array<string,mixed>>
     *
     * @throws APIException
     */
    public function getCulture(
        string $teamID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<Team>>
     *
     * @throws APIException
     */
    public function getRivals(
        string $teamID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<FileUpload>>
     *
     * @throws APIException
     */
    public function listLogos(
        string $teamID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}

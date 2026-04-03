<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\SkipLimitPage;
use Believe\RequestOptions;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Teams\TeamCreateParams;
use Believe\Teams\Team;
use Believe\Teams\TeamUpdateParams;
use Believe\Teams\TeamListParams;
use Believe\Teams\Logo\FileUpload;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface TeamsRawContract{

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
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $teamID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Team>
  *
  * @throws APIException
 */
    public function retrieve(
      string $teamID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $teamID
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
      null|RequestOptions|array $requestOptions = null,
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
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $teamID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
    public function delete(
      string $teamID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $teamID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<array<string,mixed>>
  *
  * @throws APIException
 */
    public function getCulture(
      string $teamID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $teamID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<list<Team>>
  *
  * @throws APIException
 */
    public function getRivals(
      string $teamID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $teamID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<list<FileUpload>>
  *
  * @throws APIException
 */
    public function listLogos(
      string $teamID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

}
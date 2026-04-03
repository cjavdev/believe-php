<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\SkipLimitPage;
use Believe\RequestOptions;
use Believe\Biscuits\Biscuit;
use Believe\Biscuits\BiscuitListParams;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface BiscuitsRawContract{

    /**
  * @api
  *
  * @param string $biscuitID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Biscuit>
  *
  * @throws APIException
 */
    public function retrieve(
      string $biscuitID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

    /**
  * @api
  *
  * @param array<string,mixed>|BiscuitListParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<SkipLimitPage<Biscuit>>
  *
  * @throws APIException
 */
    public function list(
      array|BiscuitListParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Biscuit>
  *
  * @throws APIException
 */
    public function getFresh(
      null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

}
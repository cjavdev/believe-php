<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Press\PressSimulateResponse;
use Believe\Press\PressSimulateParams;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface PressRawContract{

    /**
  * @api
  *
  * @param array<string,mixed>|PressSimulateParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<PressSimulateResponse>
  *
  * @throws APIException
 */
    public function simulate(
      array|PressSimulateParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

}
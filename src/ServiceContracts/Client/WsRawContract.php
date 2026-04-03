<?php

declare(strict_types=1);

namespace Believe\ServiceContracts\Client;

use Believe\RequestOptions;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface WsRawContract{

    /**
  * @api
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
    public function test(
      null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

}
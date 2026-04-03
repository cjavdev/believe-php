<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface VersionRawContract{

    /**
  * @api
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
    public function retrieve(
      null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

}
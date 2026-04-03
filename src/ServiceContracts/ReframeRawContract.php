<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Reframe\ReframeTransformNegativeThoughtsResponse;
use Believe\Reframe\ReframeTransformNegativeThoughtsParams;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface ReframeRawContract{

    /**
  * @api
  *
  * @param array<string,mixed>|ReframeTransformNegativeThoughtsParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<ReframeTransformNegativeThoughtsResponse>
  *
  * @throws APIException
 */
    public function transformNegativeThoughts(
      array|ReframeTransformNegativeThoughtsParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

}
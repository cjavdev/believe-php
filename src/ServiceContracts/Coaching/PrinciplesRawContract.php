<?php

declare(strict_types=1);

namespace Believe\ServiceContracts\Coaching;

use Believe\SkipLimitPage;
use Believe\RequestOptions;
use Believe\Coaching\Principles\CoachingPrinciple;
use Believe\Coaching\Principles\PrincipleListParams;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface PrinciplesRawContract{

    /**
  * @api
  *
  * @param string $principleID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<CoachingPrinciple>
  *
  * @throws APIException
 */
    public function retrieve(
      string $principleID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

    /**
  * @api
  *
  * @param array<string,mixed>|PrincipleListParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<SkipLimitPage<CoachingPrinciple>>
  *
  * @throws APIException
 */
    public function list(
      array|PrincipleListParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<CoachingPrinciple>
  *
  * @throws APIException
 */
    public function getRandom(
      null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

}
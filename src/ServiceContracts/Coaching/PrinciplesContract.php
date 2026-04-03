<?php

declare(strict_types=1);

namespace Believe\ServiceContracts\Coaching;

use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Coaching\Principles\CoachingPrinciple;
use Believe\Core\Exceptions\APIException;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface PrinciplesContract{

    /**
  * @api
  *
  * @param string $principleID
  * @param RequestOpts|null $requestOptions
  *
  * @return CoachingPrinciple
  *
  * @throws APIException
 */
    public function retrieve(
      string $principleID, null|RequestOptions|array $requestOptions = null
    ): CoachingPrinciple;

    /**
  * @api
  *
  * @param int $limit Maximum number of items to return (max: 100)
  * @param int $skip Number of items to skip (offset)
  * @param RequestOpts|null $requestOptions
  *
  * @return SkipLimitPage<CoachingPrinciple>
  *
  * @throws APIException
 */
    public function list(
      int $limit = 20,
      int $skip = 0,
      null|RequestOptions|array $requestOptions = null,
    ): SkipLimitPage;

    /**
  * @api
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return CoachingPrinciple
  *
  * @throws APIException
 */
    public function getRandom(
      null|RequestOptions|array $requestOptions = null
    ): CoachingPrinciple;

}
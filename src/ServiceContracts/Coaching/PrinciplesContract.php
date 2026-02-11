<?php

declare(strict_types=1);

namespace Believe\ServiceContracts\Coaching;

use Believe\Coaching\Principles\CoachingPrinciple;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\SkipLimitPage;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface PrinciplesContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $principleID,
        RequestOptions|array|null $requestOptions = null
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
        RequestOptions|array|null $requestOptions = null,
    ): SkipLimitPage;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getRandom(
        RequestOptions|array|null $requestOptions = null
    ): CoachingPrinciple;
}

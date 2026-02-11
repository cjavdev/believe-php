<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Exceptions\APIException;
use Believe\Reframe\ReframeTransformNegativeThoughtsResponse;
use Believe\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface ReframeContract
{
    /**
     * @api
     *
     * @param string $negativeThought The negative thought to reframe
     * @param bool $recurring Is this a recurring thought?
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function transformNegativeThoughts(
        string $negativeThought,
        bool $recurring = false,
        RequestOptions|array|null $requestOptions = null,
    ): ReframeTransformNegativeThoughtsResponse;
}

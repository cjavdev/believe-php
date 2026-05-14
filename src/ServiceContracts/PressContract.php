<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Exceptions\APIException;
use Believe\Press\PressSimulateResponse;
use Believe\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface PressContract
{
    /**
     * @api
     *
     * @param string $question The press question to answer
     * @param bool $hostile Is this a hostile question from Trent Crimm?
     * @param string|null $topic Topic category
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function simulate(
        string $question,
        bool $hostile = false,
        ?string $topic = null,
        RequestOptions|array|null $requestOptions = null,
    ): PressSimulateResponse;
}

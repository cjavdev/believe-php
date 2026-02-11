<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface HealthContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function check(
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}

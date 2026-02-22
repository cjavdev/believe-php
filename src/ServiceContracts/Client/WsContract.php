<?php

declare(strict_types=1);

namespace Believe\ServiceContracts\Client;

use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface WsContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function test(
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}

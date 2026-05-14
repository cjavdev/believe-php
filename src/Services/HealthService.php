<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\ServiceContracts\HealthContract;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class HealthService implements HealthContract
{
    /**
     * @api
     */
    public HealthRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new HealthRawService($client);
    }

    /**
     * @api
     *
     * Check if the API is running and healthy.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function check(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->check(requestOptions: $requestOptions);

        return $response->parse();
    }
}

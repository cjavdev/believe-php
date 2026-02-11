<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\ServiceContracts\VersionContract;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class VersionService implements VersionContract
{
    /**
     * @api
     */
    public VersionRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new VersionRawService($client);
    }

    /**
     * @api
     *
     * Get detailed information about API versioning.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(requestOptions: $requestOptions);

        return $response->parse();
    }
}

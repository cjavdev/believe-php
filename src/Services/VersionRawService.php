<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\ServiceContracts\VersionRawContract;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class VersionRawService implements VersionRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get detailed information about API versioning.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'version',
            options: $requestOptions,
            convert: 'mixed'
        );
    }
}

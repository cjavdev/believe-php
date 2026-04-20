<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\ServiceContracts\StreamRawContract;

/**
 * Server-Sent Events (SSE) streaming endpoints.
 *
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class StreamRawService implements StreamRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * A simple SSE test endpoint that streams numbers 1-5.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function testConnection(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'stream/test',
            options: $requestOptions,
            convert: 'mixed',
        );
    }
}

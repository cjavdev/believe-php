<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\ServiceContracts\StreamContract;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class StreamService implements StreamContract
{
    /**
     * @api
     */
    public StreamRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new StreamRawService($client);
    }

    /**
     * @api
     *
     * A simple SSE test endpoint that streams numbers 1-5.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function testConnection(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->testConnection(requestOptions: $requestOptions);

        return $response->parse();
    }
}

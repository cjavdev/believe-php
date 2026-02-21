<?php

declare(strict_types=1);

namespace Believe\Services\Client;

use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\ServiceContracts\Client\WsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class WsRawService implements WsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simple WebSocket test endpoint for connectivity testing.
     *
     * Connect to test WebSocket functionality. The server will:
     * 1. Send a welcome message on connection
     * 2. Echo back any message you send
     *
     * ## Example
     *
     * ```javascript
     * const ws = new WebSocket('ws://localhost:8000/ws/test');
     * ws.onmessage = (event) => console.log(event.data);
     * ws.send('Hello!');  // Server responds with echo
     * ```
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function test(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'ws/test',
            options: $requestOptions,
            convert: null
        );
    }
}

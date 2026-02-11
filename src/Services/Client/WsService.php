<?php

declare(strict_types=1);

namespace Believe\Services\Client;

use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\ServiceContracts\Client\WsContract;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class WsService implements WsContract
{
    /**
     * @api
     */
    public WsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WsRawService($client);
    }

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
     * @throws APIException
     */
    public function test(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->test(requestOptions: $requestOptions);

        return $response->parse();
    }
}

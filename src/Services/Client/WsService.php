<?php

declare(strict_types=1);

namespace Believe\Services\Client;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\Client\WsContract;

/**
  * WebSocket endpoints for real-time bidirectional communication - Live match simulation
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class WsService implements WsContract
{
  /**
  * @api
  *
  * @var WsRawService $raw
 */
  public WsRawService $raw;

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
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
  public function test(
    null|RequestOptions|array $requestOptions = null
  ): mixed {
    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->test(requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new WsRawService($client);
  }
}
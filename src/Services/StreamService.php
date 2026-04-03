<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\StreamContract;

/**
  * Server-Sent Events (SSE) streaming endpoints
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class StreamService implements StreamContract
{
  /**
  * @api
  *
  * @var StreamRawService $raw
 */
  public StreamRawService $raw;

  /**
  * @api
  *
  * A simple SSE test endpoint that streams numbers 1-5.
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
  public function testConnection(
    null|RequestOptions|array $requestOptions = null
  ): mixed {
    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->testConnection(requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new StreamRawService($client);
  }
}
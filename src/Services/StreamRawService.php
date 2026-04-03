<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\StreamRawContract;

/**
  * Server-Sent Events (SSE) streaming endpoints
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class StreamRawService implements StreamRawContract
{
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
    null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: 'stream/test',
      options: $requestOptions,
      convert: 'mixed',
    );
  }

  // @phpstan-ignore-next-line
  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {}
}
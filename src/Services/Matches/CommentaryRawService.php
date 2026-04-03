<?php

declare(strict_types=1);

namespace Believe\Services\Matches;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\Matches\CommentaryRawContract;

/**
  * Server-Sent Events (SSE) streaming endpoints
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class CommentaryRawService implements CommentaryRawContract
{
  /**
  * @api
  *
  * Stream live match commentary for a specific match. Uses Server-Sent Events (SSE) to stream commentary events in real-time.
  *
  * @param string $matchID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
  public function stream(
    string $matchID, null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'post',
      path: ['matches/%1$s/commentary/stream', $matchID],
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
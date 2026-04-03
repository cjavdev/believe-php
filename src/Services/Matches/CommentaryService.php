<?php

declare(strict_types=1);

namespace Believe\Services\Matches;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\Matches\CommentaryContract;

/**
  * Server-Sent Events (SSE) streaming endpoints
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class CommentaryService implements CommentaryContract
{
  /**
  * @api
  *
  * @var CommentaryRawService $raw
 */
  public CommentaryRawService $raw;

  /**
  * @api
  *
  * Stream live match commentary for a specific match. Uses Server-Sent Events (SSE) to stream commentary events in real-time.
  *
  * @param string $matchID
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
  public function stream(
    string $matchID, null|RequestOptions|array $requestOptions = null
  ): mixed {
    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->stream($matchID, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new CommentaryRawService($client);
  }
}
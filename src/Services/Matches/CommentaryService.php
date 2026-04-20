<?php

declare(strict_types=1);

namespace Believe\Services\Matches;

use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\ServiceContracts\Matches\CommentaryContract;

/**
 * Server-Sent Events (SSE) streaming endpoints.
 *
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class CommentaryService implements CommentaryContract
{
    /**
     * @api
     */
    public CommentaryRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CommentaryRawService($client);
    }

    /**
     * @api
     *
     * Stream live match commentary for a specific match. Uses Server-Sent Events (SSE) to stream commentary events in real-time.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function stream(
        string $matchID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->stream($matchID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

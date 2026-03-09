<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\PepTalk\PepTalkGetResponse;
use Believe\RequestOptions;
use Believe\ServiceContracts\PepTalkContract;

/**
 * Server-Sent Events (SSE) streaming endpoints.
 *
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class PepTalkService implements PepTalkContract
{
    /**
     * @api
     */
    public PepTalkRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PepTalkRawService($client);
    }

    /**
     * @api
     *
     * Get a motivational pep talk from Ted Lasso himself. By default returns the complete pep talk. Add `?stream=true` to get Server-Sent Events (SSE) streaming the pep talk chunk by chunk.
     *
     * @param bool $stream If true, returns SSE stream instead of full response
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        bool $stream = false,
        RequestOptions|array|null $requestOptions = null
    ): PepTalkGetResponse {
        $params = Util::removeNulls(['stream' => $stream]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

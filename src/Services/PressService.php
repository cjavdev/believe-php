<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\Press\PressSimulateResponse;
use Believe\RequestOptions;
use Believe\ServiceContracts\PressContract;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class PressService implements PressContract
{
    /**
     * @api
     */
    public PressRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PressRawService($client);
    }

    /**
     * @api
     *
     * Get Ted's response to press conference questions.
     *
     * @param string $question The press question to answer
     * @param bool $hostile Is this a hostile question from Trent Crimm?
     * @param string|null $topic Topic category
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function simulate(
        string $question,
        bool $hostile = false,
        ?string $topic = null,
        RequestOptions|array|null $requestOptions = null,
    ): PressSimulateResponse {
        $params = Util::removeNulls(
            ['question' => $question, 'hostile' => $hostile, 'topic' => $topic]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->simulate(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

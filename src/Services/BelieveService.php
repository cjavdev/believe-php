<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Believe\BelieveSubmitParams\SituationType;
use Believe\Believe\BelieveSubmitResponse;
use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\RequestOptions;
use Believe\ServiceContracts\BelieveContract;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class BelieveService implements BelieveContract
{
    /**
     * @api
     */
    public BelieveRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BelieveRawService($client);
    }

    /**
     * @api
     *
     * Submit your situation and receive Ted Lasso-style motivational guidance.
     *
     * @param string $situation Describe your situation
     * @param SituationType|value-of<SituationType> $situationType Type of situation
     * @param string|null $context Additional context
     * @param int $intensity How intense is the response needed (1=gentle, 10=full Ted)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        string $situation,
        SituationType|string $situationType,
        ?string $context = null,
        int $intensity = 5,
        RequestOptions|array|null $requestOptions = null,
    ): BelieveSubmitResponse {
        $params = Util::removeNulls(
            [
                'situation' => $situation,
                'situationType' => $situationType,
                'context' => $context,
                'intensity' => $intensity,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->submit(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

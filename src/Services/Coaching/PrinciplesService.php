<?php

declare(strict_types=1);

namespace Believe\Services\Coaching;

use Believe\Client;
use Believe\Coaching\Principles\CoachingPrinciple;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\RequestOptions;
use Believe\ServiceContracts\Coaching\PrinciplesContract;
use Believe\SkipLimitPage;

/**
 * Interactive endpoints for motivation and guidance.
 *
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class PrinciplesService implements PrinciplesContract
{
    /**
     * @api
     */
    public PrinciplesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PrinciplesRawService($client);
    }

    /**
     * @api
     *
     * Get details about a specific coaching principle.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $principleID,
        RequestOptions|array|null $requestOptions = null
    ): CoachingPrinciple {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($principleID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a paginated list of Ted Lasso's core coaching principles and philosophy.
     *
     * @param int $limit Maximum number of items to return (max: 100)
     * @param int $skip Number of items to skip (offset)
     * @param RequestOpts|null $requestOptions
     *
     * @return SkipLimitPage<CoachingPrinciple>
     *
     * @throws APIException
     */
    public function list(
        int $limit = 20,
        int $skip = 0,
        RequestOptions|array|null $requestOptions = null,
    ): SkipLimitPage {
        $params = Util::removeNulls(['limit' => $limit, 'skip' => $skip]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a random coaching principle to inspire your day.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getRandom(
        RequestOptions|array|null $requestOptions = null
    ): CoachingPrinciple {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getRandom(requestOptions: $requestOptions);

        return $response->parse();
    }
}

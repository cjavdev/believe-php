<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Biscuits\Biscuit;
use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\RequestOptions;
use Believe\ServiceContracts\BiscuitsContract;
use Believe\SkipLimitPage;

/**
 * Interactive endpoints for motivation and guidance.
 *
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class BiscuitsService implements BiscuitsContract
{
    /**
     * @api
     */
    public BiscuitsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BiscuitsRawService($client);
    }

    /**
     * @api
     *
     * Get a specific type of biscuit by ID.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $biscuitID,
        RequestOptions|array|null $requestOptions = null
    ): Biscuit {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($biscuitID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a paginated list of Ted's famous homemade biscuits! Each comes with a heartwarming message.
     *
     * @param int $limit Maximum number of items to return (max: 100)
     * @param int $skip Number of items to skip (offset)
     * @param RequestOpts|null $requestOptions
     *
     * @return SkipLimitPage<Biscuit>
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
     * Get a single fresh biscuit with a personalized message from Ted.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getFresh(
        RequestOptions|array|null $requestOptions = null
    ): Biscuit {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getFresh(requestOptions: $requestOptions);

        return $response->parse();
    }
}

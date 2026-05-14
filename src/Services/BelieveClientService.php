<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\ServiceContracts\BelieveClientContract;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class BelieveClientService implements BelieveClientContract
{
    /**
     * @api
     */
    public BelieveClientRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BelieveClientRawService($client);
    }

    /**
     * @api
     *
     * Get a warm welcome and overview of available endpoints.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getWelcome(
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getWelcome(requestOptions: $requestOptions);

        return $response->parse();
    }
}

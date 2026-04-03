<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Client;
use Believe\Biscuits\Biscuit;
use Believe\Core\Util;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\BiscuitsContract;

/**
  * Interactive endpoints for motivation and guidance
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class BiscuitsService implements BiscuitsContract
{
  /**
  * @api
  *
  * @var BiscuitsRawService $raw
 */
  public BiscuitsRawService $raw;

  /**
  * @api
  *
  * Get a specific type of biscuit by ID.
  *
  * @param string $biscuitID
  * @param RequestOpts|null $requestOptions
  *
  * @return Biscuit
  *
  * @throws APIException
 */
  public function retrieve(
    string $biscuitID, null|RequestOptions|array $requestOptions = null
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
    null|RequestOptions|array $requestOptions = null,
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
  * @return Biscuit
  *
  * @throws APIException
 */
  public function getFresh(
    null|RequestOptions|array $requestOptions = null
  ): Biscuit {
    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->getFresh(requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new BiscuitsRawService($client);
  }
}
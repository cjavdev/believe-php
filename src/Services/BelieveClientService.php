<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\BelieveClientContract;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class BelieveClientService implements BelieveClientContract
{
  /**
  * @api
  *
  * @var BelieveClientRawService $raw
 */
  public BelieveClientRawService $raw;

  /**
  * @api
  *
  * Get a warm welcome and overview of available endpoints.
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
  public function getWelcome(
    null|RequestOptions|array $requestOptions = null
  ): mixed {
    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->getWelcome(requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new BelieveClientRawService($client);
  }
}
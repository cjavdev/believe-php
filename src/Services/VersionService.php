<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\VersionContract;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class VersionService implements VersionContract
{
  /**
  * @api
  *
  * @var VersionRawService $raw
 */
  public VersionRawService $raw;

  /**
  * @api
  *
  * Get detailed information about API versioning.
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
  public function retrieve(
    null|RequestOptions|array $requestOptions = null
  ): mixed {
    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->retrieve(requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new VersionRawService($client);
  }
}
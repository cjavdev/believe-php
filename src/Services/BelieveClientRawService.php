<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\BelieveClientRawContract;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class BelieveClientRawService implements BelieveClientRawContract
{
  /**
  * @api
  *
  * Get a warm welcome and overview of available endpoints.
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
  public function getWelcome(
    null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get', path: '', options: $requestOptions, convert: 'mixed'
    );
  }

  // @phpstan-ignore-next-line
  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {}
}
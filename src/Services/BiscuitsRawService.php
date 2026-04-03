<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Client;
use Believe\Biscuits\Biscuit;
use Believe\Biscuits\BiscuitListParams;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\BiscuitsRawContract;

/**
  * Interactive endpoints for motivation and guidance
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class BiscuitsRawService implements BiscuitsRawContract
{
  /**
  * @api
  *
  * Get a specific type of biscuit by ID.
  *
  * @param string $biscuitID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Biscuit>
  *
  * @throws APIException
 */
  public function retrieve(
    string $biscuitID, null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: ['biscuits/%1$s', $biscuitID],
      options: $requestOptions,
      convert: Biscuit::class,
    );
  }

  /**
  * @api
  *
  * Get a paginated list of Ted's famous homemade biscuits! Each comes with a heartwarming message.
  *
  * @param array{limit?: int, skip?: int}|BiscuitListParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<SkipLimitPage<Biscuit>>
  *
  * @throws APIException
 */
  public function list(
    array|BiscuitListParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = BiscuitListParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: 'biscuits',
      query: $parsed,
      options: $options,
      convert: Biscuit::class,
      page: SkipLimitPage::class,
    );
  }

  /**
  * @api
  *
  * Get a single fresh biscuit with a personalized message from Ted.
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Biscuit>
  *
  * @throws APIException
 */
  public function getFresh(
    null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: 'biscuits/fresh',
      options: $requestOptions,
      convert: Biscuit::class,
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
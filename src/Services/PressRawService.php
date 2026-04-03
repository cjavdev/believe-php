<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Press\PressSimulateParams;
use Believe\Press\PressSimulateResponse;
use Believe\ServiceContracts\PressRawContract;

/**
  * Interactive endpoints for motivation and guidance
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class PressRawService implements PressRawContract
{
  /**
  * @api
  *
  * Get Ted's response to press conference questions.
  *
  * @param array{
  *   question: string, hostile?: bool, topic?: string|null
  * }|PressSimulateParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<PressSimulateResponse>
  *
  * @throws APIException
 */
  public function simulate(
    array|PressSimulateParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = PressSimulateParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'post',
      path: 'press',
      body: (object) $parsed,
      options: $options,
      convert: PressSimulateResponse::class,
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
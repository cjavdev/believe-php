<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Believe\BelieveSubmitParams;
use Believe\Believe\BelieveSubmitResponse;
use Believe\Believe\BelieveSubmitParams\SituationType;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\BelieveRawContract;

/**
  * Interactive endpoints for motivation and guidance
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class BelieveRawService implements BelieveRawContract
{
  /**
  * @api
  *
  * Submit your situation and receive Ted Lasso-style motivational guidance.
  *
  * @param array{
  *   situation: string,
  *   situationType: value-of<SituationType>,
  *   context?: string|null,
  *   intensity?: int,
  * }|BelieveSubmitParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<BelieveSubmitResponse>
  *
  * @throws APIException
 */
  public function submit(
    array|BelieveSubmitParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = BelieveSubmitParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'post',
      path: 'believe',
      body: (object) $parsed,
      options: $options,
      convert: BelieveSubmitResponse::class,
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
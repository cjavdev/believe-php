<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Reframe\ReframeTransformNegativeThoughtsParams;
use Believe\Reframe\ReframeTransformNegativeThoughtsResponse;
use Believe\ServiceContracts\ReframeRawContract;

/**
  * Interactive endpoints for motivation and guidance
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class ReframeRawService implements ReframeRawContract
{
  /**
  * @api
  *
  * Transform negative thoughts into positive perspectives with Ted's help.
  *
  * @param array{
  *   negativeThought: string, recurring?: bool
  * }|ReframeTransformNegativeThoughtsParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<ReframeTransformNegativeThoughtsResponse>
  *
  * @throws APIException
 */
  public function transformNegativeThoughts(
    array|ReframeTransformNegativeThoughtsParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = ReframeTransformNegativeThoughtsParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'post',
      path: 'reframe',
      body: (object) $parsed,
      options: $options,
      convert: ReframeTransformNegativeThoughtsResponse::class,
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
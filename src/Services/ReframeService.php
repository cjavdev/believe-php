<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Util;
use Believe\Core\Exceptions\APIException;
use Believe\Reframe\ReframeTransformNegativeThoughtsResponse;
use Believe\ServiceContracts\ReframeContract;

/**
  * Interactive endpoints for motivation and guidance
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class ReframeService implements ReframeContract
{
  /**
  * @api
  *
  * @var ReframeRawService $raw
 */
  public ReframeRawService $raw;

  /**
  * @api
  *
  * Transform negative thoughts into positive perspectives with Ted's help.
  *
  * @param string $negativeThought The negative thought to reframe
  * @param bool $recurring Is this a recurring thought?
  * @param RequestOpts|null $requestOptions
  *
  * @return ReframeTransformNegativeThoughtsResponse
  *
  * @throws APIException
 */
  public function transformNegativeThoughts(
    string $negativeThought,
    bool $recurring = false,
    null|RequestOptions|array $requestOptions = null,
  ): ReframeTransformNegativeThoughtsResponse {
    $params = Util::removeNulls(
      ['negativeThought' => $negativeThought, 'recurring' => $recurring]
    );

    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->transformNegativeThoughts(params: $params, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new ReframeRawService($client);
  }
}
<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\PepTalk\PepTalkRetrieveParams;
use Believe\PepTalk\PepTalkGetResponse;
use Believe\ServiceContracts\PepTalkRawContract;

/**
  * Server-Sent Events (SSE) streaming endpoints
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class PepTalkRawService implements PepTalkRawContract
{
  /**
  * @api
  *
  * Get a motivational pep talk from Ted Lasso himself. By default returns the complete pep talk. Add `?stream=true` to get Server-Sent Events (SSE) streaming the pep talk chunk by chunk.
  *
  * @param array{stream?: bool}|PepTalkRetrieveParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<PepTalkGetResponse>
  *
  * @throws APIException
 */
  public function retrieve(
    array|PepTalkRetrieveParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = PepTalkRetrieveParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: 'pep-talk',
      query: $parsed,
      options: $options,
      convert: PepTalkGetResponse::class,
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
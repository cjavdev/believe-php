<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Util;
use Believe\Core\Exceptions\APIException;
use Believe\Press\PressSimulateResponse;
use Believe\ServiceContracts\PressContract;

/**
  * Interactive endpoints for motivation and guidance
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class PressService implements PressContract
{
  /**
  * @api
  *
  * @var PressRawService $raw
 */
  public PressRawService $raw;

  /**
  * @api
  *
  * Get Ted's response to press conference questions.
  *
  * @param string $question The press question to answer
  * @param bool $hostile Is this a hostile question from Trent Crimm?
  * @param string|null $topic Topic category
  * @param RequestOpts|null $requestOptions
  *
  * @return PressSimulateResponse
  *
  * @throws APIException
 */
  public function simulate(
    string $question,
    bool $hostile = false,
    ?string $topic = null,
    null|RequestOptions|array $requestOptions = null,
  ): PressSimulateResponse {
    $params = Util::removeNulls(
      ['question' => $question, 'hostile' => $hostile, 'topic' => $topic]
    );

    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->simulate(params: $params, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new PressRawService($client);
  }
}
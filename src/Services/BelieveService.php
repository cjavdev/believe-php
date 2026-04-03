<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Believe\BelieveSubmitResponse;
use Believe\Believe\BelieveSubmitParams\SituationType;
use Believe\Core\Util;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\BelieveContract;

/**
  * Interactive endpoints for motivation and guidance
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class BelieveService implements BelieveContract
{
  /**
  * @api
  *
  * @var BelieveRawService $raw
 */
  public BelieveRawService $raw;

  /**
  * @api
  *
  * Submit your situation and receive Ted Lasso-style motivational guidance.
  *
  * @param string $situation Describe your situation
  * @param SituationType|value-of<SituationType> $situationType Type of situation
  * @param string|null $context Additional context
  * @param int $intensity How intense is the response needed (1=gentle, 10=full Ted)
  * @param RequestOpts|null $requestOptions
  *
  * @return BelieveSubmitResponse
  *
  * @throws APIException
 */
  public function submit(
    string $situation,
    SituationType|string $situationType,
    ?string $context = null,
    int $intensity = 5,
    null|RequestOptions|array $requestOptions = null,
  ): BelieveSubmitResponse {
    $params = Util::removeNulls(
      [
        'situation' => $situation,
        'situationType' => $situationType,
        'context' => $context,
        'intensity' => $intensity,
      ],
    );

    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->submit(params: $params, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new BelieveRawService($client);
  }
}
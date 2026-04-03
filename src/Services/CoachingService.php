<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\ServiceContracts\CoachingContract;
use Believe\Services\Coaching\PrinciplesService;

/**
  *
  *
 */
final class CoachingService implements CoachingContract
{
  /**
  * @api
  *
  * @var CoachingRawService $raw
 */
  public CoachingRawService $raw;

  /**
  * @api
  *
  * @var PrinciplesService $principles
 */
  public PrinciplesService $principles;

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new CoachingRawService($client);
    $this->principles = new PrinciplesService($client);
  }
}
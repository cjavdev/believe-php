<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\ServiceContracts\ClientRawContract;

/**
  *
  *
 */
final class ClientRawService implements ClientRawContract
{
  // @phpstan-ignore-next-line
  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {}
}
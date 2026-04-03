<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\ServiceContracts\ClientContract;
use Believe\Services\Client\WsService;

/**
  *
  *
 */
final class ClientService implements ClientContract
{
  /**
  * @api
  *
  * @var ClientRawService $raw
 */
  public ClientRawService $raw;

  /**
  * @api
  *
  * @var WsService $ws
 */
  public WsService $ws;

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new ClientRawService($client);
    $this->ws = new WsService($client);
  }
}
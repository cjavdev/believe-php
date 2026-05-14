<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\ServiceContracts\ClientContract;
use Believe\Services\Client\WsService;

final class ClientService implements ClientContract
{
    /**
     * @api
     */
    public ClientRawService $raw;

    /**
     * @api
     */
    public WsService $ws;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ClientRawService($client);
        $this->ws = new WsService($client);
    }
}

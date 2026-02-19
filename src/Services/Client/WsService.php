<?php

declare(strict_types=1);

namespace Believe\Services\Client;

use Believe\Client;
use Believe\ServiceContracts\Client\WsContract;

final class WsService implements WsContract
{
    /**
     * @api
     */
    public WsRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WsRawService($client);
    }
}

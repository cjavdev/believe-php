<?php

declare(strict_types=1);

namespace Believe\Services\Client;

use Believe\Client;
use Believe\ServiceContracts\Client\WsRawContract;

final class WsRawService implements WsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}

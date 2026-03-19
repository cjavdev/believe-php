<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\ServiceContracts\ClientRawContract;

final class ClientRawService implements ClientRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}

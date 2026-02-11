<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\ServiceContracts\CoachingContract;
use Believe\Services\Coaching\PrinciplesService;

final class CoachingService implements CoachingContract
{
    /**
     * @api
     */
    public CoachingRawService $raw;

    /**
     * @api
     */
    public PrinciplesService $principles;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CoachingRawService($client);
        $this->principles = new PrinciplesService($client);
    }
}

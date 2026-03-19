<?php

declare(strict_types=1);

namespace Believe\Webhooks\MatchCompletedWebhookEvent\Data;

/**
 * Match result from home team perspective.
 */
enum Result: string
{
    case HOME_WIN = 'home_win';

    case AWAY_WIN = 'away_win';

    case DRAW = 'draw';
}

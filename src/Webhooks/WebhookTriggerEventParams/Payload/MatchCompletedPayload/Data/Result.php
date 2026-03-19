<?php

declare(strict_types=1);

namespace Believe\Webhooks\WebhookTriggerEventParams\Payload\MatchCompletedPayload\Data;

/**
 * Match result from home team perspective.
 */
enum Result: string
{
    case HOME_WIN = 'home_win';

    case AWAY_WIN = 'away_win';

    case DRAW = 'draw';
}

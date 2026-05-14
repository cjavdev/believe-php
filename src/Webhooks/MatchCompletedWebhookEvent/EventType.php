<?php

declare(strict_types=1);

namespace Believe\Webhooks\MatchCompletedWebhookEvent;

/**
 * The type of webhook event.
 */
enum EventType: string
{
    case MATCH_COMPLETED = 'match.completed';
}

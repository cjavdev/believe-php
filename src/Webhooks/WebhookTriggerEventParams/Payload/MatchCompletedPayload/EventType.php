<?php

declare(strict_types=1);

namespace Believe\Webhooks\WebhookTriggerEventParams\Payload\MatchCompletedPayload;

/**
 * The type of webhook event.
 */
enum EventType: string
{
    case MATCH_COMPLETED = 'match.completed';
}

<?php

declare(strict_types=1);

namespace Believe\Webhooks\WebhookTriggerEventParams;

/**
 * The type of event to trigger.
 */
enum EventType: string
{
    case MATCH_COMPLETED = 'match.completed';

    case TEAM_MEMBER_TRANSFERRED = 'team_member.transferred';
}

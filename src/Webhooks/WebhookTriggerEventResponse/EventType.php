<?php

declare(strict_types=1);

namespace Believe\Webhooks\WebhookTriggerEventResponse;

/**
  * The type of event triggered
  *
 */
enum EventType : string
{

    case MATCH_COMPLETED = 'match.completed';

    case TEAM_MEMBER_TRANSFERRED = 'team_member.transferred';

}
<?php

declare(strict_types=1);

namespace Believe\Webhooks\RegisteredWebhook;

enum EventType : string
{

    case MATCH_COMPLETED = 'match.completed';

    case TEAM_MEMBER_TRANSFERRED = 'team_member.transferred';

}
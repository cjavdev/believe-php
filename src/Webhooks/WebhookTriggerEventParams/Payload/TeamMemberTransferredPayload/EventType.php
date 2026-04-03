<?php

declare(strict_types=1);

namespace Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload;

/**
  * The type of webhook event
  *
 */
enum EventType : string
{

    case TEAM_MEMBER_TRANSFERRED = 'team_member.transferred';

}
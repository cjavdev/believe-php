<?php

declare(strict_types=1);

namespace Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload\Data;

/**
  * Type of team member
  *
 */
enum MemberType : string
{

    case PLAYER = 'player';

    case COACH = 'coach';

    case MEDICAL_STAFF = 'medical_staff';

    case EQUIPMENT_MANAGER = 'equipment_manager';

}
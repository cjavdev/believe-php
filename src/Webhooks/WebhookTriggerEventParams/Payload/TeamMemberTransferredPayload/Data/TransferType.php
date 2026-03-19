<?php

declare(strict_types=1);

namespace Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload\Data;

/**
 * Whether the member joined or departed.
 */
enum TransferType: string
{
    case JOINED = 'joined';

    case DEPARTED = 'departed';
}

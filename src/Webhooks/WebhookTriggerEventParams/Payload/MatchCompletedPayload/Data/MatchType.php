<?php

declare(strict_types=1);

namespace Believe\Webhooks\WebhookTriggerEventParams\Payload\MatchCompletedPayload\Data;

/**
  * Type of match
  *
 */
enum MatchType : string
{

    case LEAGUE = 'league';

    case CUP = 'cup';

    case FRIENDLY = 'friendly';

    case PLAYOFF = 'playoff';

    case FINAL = 'final';

}
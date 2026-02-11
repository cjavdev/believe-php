<?php

declare(strict_types=1);

namespace Believe\Believe\BelieveSubmitParams;

/**
 * Type of situation.
 */
enum SituationType: string
{
    case WORK_CHALLENGE = 'work_challenge';

    case PERSONAL_SETBACK = 'personal_setback';

    case TEAM_CONFLICT = 'team_conflict';

    case SELF_DOUBT = 'self_doubt';

    case BIG_DECISION = 'big_decision';

    case FAILURE = 'failure';

    case NEW_BEGINNING = 'new_beginning';

    case RELATIONSHIP = 'relationship';
}

<?php

declare(strict_types=1);

namespace Believe\Matches;

/**
 * Types of matches.
 */
enum MatchType: string
{
    case LEAGUE = 'league';

    case CUP = 'cup';

    case FRIENDLY = 'friendly';

    case PLAYOFF = 'playoff';

    case FINAL = 'final';
}

<?php

declare(strict_types=1);

namespace Believe\Matches;

/**
  * Match result types.
  *
 */
enum MatchResult : string
{

    case WIN = 'win';

    case LOSS = 'loss';

    case DRAW = 'draw';

    case PENDING = 'pending';

}
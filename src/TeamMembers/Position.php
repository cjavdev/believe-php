<?php

declare(strict_types=1);

namespace Believe\TeamMembers;

/**
 * Football positions for players.
 */
enum Position: string
{
    case GOALKEEPER = 'goalkeeper';

    case DEFENDER = 'defender';

    case MIDFIELDER = 'midfielder';

    case FORWARD = 'forward';
}

<?php

declare(strict_types=1);

namespace Believe\Characters;

/**
 * Roles characters can have.
 */
enum CharacterRole: string
{
    case COACH = 'coach';

    case PLAYER = 'player';

    case OWNER = 'owner';

    case MANAGER = 'manager';

    case STAFF = 'staff';

    case JOURNALIST = 'journalist';

    case FAMILY = 'family';

    case FRIEND = 'friend';

    case FAN = 'fan';

    case OTHER = 'other';
}

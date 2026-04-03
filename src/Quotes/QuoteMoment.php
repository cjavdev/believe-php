<?php

declare(strict_types=1);

namespace Believe\Quotes;

/**
  * Types of moments when quotes occur.
  *
 */
enum QuoteMoment : string
{

    case HALFTIME_SPEECH = 'halftime_speech';

    case PRESS_CONFERENCE = 'press_conference';

    case LOCKER_ROOM = 'locker_room';

    case TRAINING = 'training';

    case BISCUITS_WITH_BOSS = 'biscuits_with_boss';

    case PUB = 'pub';

    case ONE_ON_ONE = 'one_on_one';

    case CELEBRATION = 'celebration';

    case CRISIS = 'crisis';

    case CASUAL = 'casual';

    case CONFRONTATION = 'confrontation';

}
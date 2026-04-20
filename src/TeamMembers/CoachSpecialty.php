<?php

declare(strict_types=1);

namespace Believe\TeamMembers;

/**
 * Coaching specialties.
 */
enum CoachSpecialty: string
{
    case HEAD_COACH = 'head_coach';

    case ASSISTANT_COACH = 'assistant_coach';

    case GOALKEEPING_COACH = 'goalkeeping_coach';

    case FITNESS_COACH = 'fitness_coach';

    case TACTICAL_ANALYST = 'tactical_analyst';
}

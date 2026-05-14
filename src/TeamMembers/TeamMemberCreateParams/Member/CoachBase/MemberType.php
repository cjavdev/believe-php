<?php

declare(strict_types=1);

namespace Believe\TeamMembers\TeamMemberCreateParams\Member\CoachBase;

/**
 * Discriminator field indicating this is a coach.
 */
enum MemberType: string
{
    case COACH = 'coach';
}

<?php

declare(strict_types=1);

namespace Believe\TeamMembers\Coach;

/**
  * Discriminator field indicating this is a coach
  *
 */
enum MemberType : string
{

    case COACH = 'coach';

}
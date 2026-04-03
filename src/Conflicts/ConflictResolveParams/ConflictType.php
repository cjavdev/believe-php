<?php

declare(strict_types=1);

namespace Believe\Conflicts\ConflictResolveParams;

/**
  * Type of conflict
  *
 */
enum ConflictType : string
{

    case INTERPERSONAL = 'interpersonal';

    case TEAM_DYNAMICS = 'team_dynamics';

    case LEADERSHIP = 'leadership';

    case EGO = 'ego';

    case MISCOMMUNICATION = 'miscommunication';

    case COMPETITION = 'competition';

}
<?php

declare(strict_types=1);

namespace Believe\TeamMembers\Player;

/**
  * Discriminator field indicating this is a player
  *
 */
enum MemberType : string
{

    case PLAYER = 'player';

}
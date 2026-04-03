<?php

declare(strict_types=1);

namespace Believe\TeamMembers\TeamMemberCreateParams\Member\EquipmentManagerBase;

/**
  * Discriminator field indicating this is an equipment manager
  *
 */
enum MemberType : string
{

    case EQUIPMENT_MANAGER = 'equipment_manager';

}
<?php

declare(strict_types=1);

namespace Believe\TeamMembers;

use Believe\Core\Concerns\SdkUnion;
use Believe\Core\Conversion\Contracts\ConverterSource;
use Believe\Core\Conversion\Contracts\Converter;

/**
  * Full player model with ID.
  * @phpstan-import-type PlayerShape from \Believe\TeamMembers\Player
  * @phpstan-import-type CoachShape from \Believe\TeamMembers\Coach
  * @phpstan-import-type MedicalStaffShape from \Believe\TeamMembers\MedicalStaff
  * @phpstan-import-type EquipmentManagerShape from \Believe\TeamMembers\EquipmentManager
  * @phpstan-type TeamMemberUpdateResponseVariants = Player|Coach|MedicalStaff|EquipmentManager
  *
  * @phpstan-type TeamMemberUpdateResponseShape = TeamMemberUpdateResponseVariants|PlayerShape|CoachShape|MedicalStaffShape|EquipmentManagerShape
  *
 */
final class TeamMemberUpdateResponse implements ConverterSource
{
  use SdkUnion;

  /** @return string */
  static function discriminator(): string {
    return 'memberType';
  }

  /**
  * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
 */
  static function variants(): array {
    return [
      'player' => Player::class,
      'coach' => Coach::class,
      'medical_staff' => MedicalStaff::class,
      'equipment_manager' => EquipmentManager::class,
    ];
  }
}
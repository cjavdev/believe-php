<?php

declare(strict_types=1);

namespace Believe\TeamMembers;

use Believe\Core\Concerns\SdkUnion;
use Believe\Core\Conversion\Contracts\ConverterSource;
use Believe\Core\Conversion\Contracts\Converter;

/**
  * Full medical staff model with ID.
  * @phpstan-import-type MedicalStaffShape from \Believe\TeamMembers\MedicalStaff
  * @phpstan-import-type EquipmentManagerShape from \Believe\TeamMembers\EquipmentManager
  * @phpstan-type TeamMemberListStaffResponseVariants = MedicalStaff|EquipmentManager
  *
  * @phpstan-type TeamMemberListStaffResponseShape = TeamMemberListStaffResponseVariants|MedicalStaffShape|EquipmentManagerShape
  *
 */
final class TeamMemberListStaffResponse implements ConverterSource
{
  use SdkUnion;

  /**
  * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
 */
  static function variants(): array {
    return [MedicalStaff::class, EquipmentManager::class];
  }
}
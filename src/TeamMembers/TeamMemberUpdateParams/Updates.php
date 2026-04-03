<?php

declare(strict_types=1);

namespace Believe\TeamMembers\TeamMemberUpdateParams;

use Believe\Core\Concerns\SdkUnion;
use Believe\Core\Conversion\Contracts\ConverterSource;
use Believe\Core\Conversion\Contracts\Converter;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\PlayerUpdate;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\CoachUpdate;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\MedicalStaffUpdate;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\EquipmentManagerUpdate;

/**
  * Update model for players.
  * @phpstan-import-type PlayerUpdateShape from \Believe\TeamMembers\TeamMemberUpdateParams\Updates\PlayerUpdate
  * @phpstan-import-type CoachUpdateShape from \Believe\TeamMembers\TeamMemberUpdateParams\Updates\CoachUpdate
  * @phpstan-import-type MedicalStaffUpdateShape from \Believe\TeamMembers\TeamMemberUpdateParams\Updates\MedicalStaffUpdate
  * @phpstan-import-type EquipmentManagerUpdateShape from \Believe\TeamMembers\TeamMemberUpdateParams\Updates\EquipmentManagerUpdate
  * @phpstan-type UpdatesVariants = PlayerUpdate|CoachUpdate|MedicalStaffUpdate|EquipmentManagerUpdate
  *
  * @phpstan-type UpdatesShape = UpdatesVariants|PlayerUpdateShape|CoachUpdateShape|MedicalStaffUpdateShape|EquipmentManagerUpdateShape
  *
 */
final class Updates implements ConverterSource
{
  use SdkUnion;

  /**
  * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
 */
  static function variants(): array {
    return [
      PlayerUpdate::class,
      CoachUpdate::class,
      MedicalStaffUpdate::class,
      EquipmentManagerUpdate::class,
    ];
  }
}
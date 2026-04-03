<?php

declare(strict_types=1);

namespace Believe\TeamMembers\TeamMemberCreateParams;

use Believe\Core\Concerns\SdkUnion;
use Believe\Core\Conversion\Contracts\ConverterSource;
use Believe\Core\Conversion\Contracts\Converter;
use Believe\TeamMembers\TeamMemberCreateParams\Member\PlayerBase;
use Believe\TeamMembers\TeamMemberCreateParams\Member\CoachBase;
use Believe\TeamMembers\TeamMemberCreateParams\Member\MedicalStaffBase;
use Believe\TeamMembers\TeamMemberCreateParams\Member\EquipmentManagerBase;

/**
  * A football player on the team.
  * @phpstan-import-type PlayerBaseShape from \Believe\TeamMembers\TeamMemberCreateParams\Member\PlayerBase
  * @phpstan-import-type CoachBaseShape from \Believe\TeamMembers\TeamMemberCreateParams\Member\CoachBase
  * @phpstan-import-type MedicalStaffBaseShape from \Believe\TeamMembers\TeamMemberCreateParams\Member\MedicalStaffBase
  * @phpstan-import-type EquipmentManagerBaseShape from \Believe\TeamMembers\TeamMemberCreateParams\Member\EquipmentManagerBase
  * @phpstan-type MemberVariants = PlayerBase|CoachBase|MedicalStaffBase|EquipmentManagerBase
  *
  * @phpstan-type MemberShape = MemberVariants|PlayerBaseShape|CoachBaseShape|MedicalStaffBaseShape|EquipmentManagerBaseShape
  *
 */
final class Member implements ConverterSource
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
      'player' => PlayerBase::class,
      'coach' => CoachBase::class,
      'medical_staff' => MedicalStaffBase::class,
      'equipment_manager' => EquipmentManagerBase::class,
    ];
  }
}
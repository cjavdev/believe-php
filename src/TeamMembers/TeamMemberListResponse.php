<?php

declare(strict_types=1);

namespace Believe\TeamMembers;

use Believe\Core\Concerns\SdkUnion;
use Believe\Core\Conversion\Contracts\Converter;
use Believe\Core\Conversion\Contracts\ConverterSource;

/**
 * Full player model with ID.
 *
 * @phpstan-import-type PlayerShape from \Believe\TeamMembers\Player
 * @phpstan-import-type CoachShape from \Believe\TeamMembers\Coach
 * @phpstan-import-type MedicalStaffShape from \Believe\TeamMembers\MedicalStaff
 * @phpstan-import-type EquipmentManagerShape from \Believe\TeamMembers\EquipmentManager
 *
 * @phpstan-type TeamMemberListResponseVariants = Player|Coach|MedicalStaff|EquipmentManager
 * @phpstan-type TeamMemberListResponseShape = TeamMemberListResponseVariants|PlayerShape|CoachShape|MedicalStaffShape|EquipmentManagerShape
 */
final class TeamMemberListResponse implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'memberType';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'player' => Player::class,
            'coach' => Coach::class,
            'medical_staff' => MedicalStaff::class,
            'equipment_manager' => EquipmentManager::class,
        ];
    }
}

<?php

declare(strict_types=1);

namespace Believe\TeamMembers\TeamMemberCreateParams\Member\MedicalStaffBase;

/**
 * Discriminator field indicating this is medical staff.
 */
enum MemberType: string
{
    case MEDICAL_STAFF = 'medical_staff';
}

<?php

declare(strict_types=1);

namespace Believe\TeamMembers;

/**
 * Medical staff specialties.
 */
enum MedicalSpecialty: string
{
    case TEAM_DOCTOR = 'team_doctor';

    case PHYSIOTHERAPIST = 'physiotherapist';

    case SPORTS_PSYCHOLOGIST = 'sports_psychologist';

    case NUTRITIONIST = 'nutritionist';

    case MASSAGE_THERAPIST = 'massage_therapist';
}

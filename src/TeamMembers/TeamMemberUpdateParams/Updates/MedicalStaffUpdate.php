<?php

declare(strict_types=1);

namespace Believe\TeamMembers\TeamMemberUpdateParams\Updates;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\TeamMembers\MedicalSpecialty;

/**
  * Update model for medical staff.
  *
  * @phpstan-type MedicalStaffUpdateShape = array{
  *   licenseNumber?: string|null,
  *   qualifications?: list<string>|null,
  *   specialty?: null|MedicalSpecialty|value-of<MedicalSpecialty>,
  *   teamID?: string|null,
  *   yearsWithTeam?: int|null,
  * }
  *
 */
final class MedicalStaffUpdate implements BaseModel
{
  /** @use SdkModel<MedicalStaffUpdateShape> */
  use SdkModel;

  /** @var string|null $licenseNumber */
  #[Optional('license_number', nullable: true)]
  public ?string $licenseNumber;

  /** @var list<string>|null $qualifications */
  #[Optional(list: 'string', nullable: true)]
  public ?array $qualifications;

  /**
  * Medical staff specialties.
  *
  * @var value-of<MedicalSpecialty>|null $specialty
 */
  #[Optional(enum: MedicalSpecialty::class, nullable: true)]
  public ?string $specialty;

  /** @var string|null $teamID */
  #[Optional('team_id', nullable: true)]
  public ?string $teamID;

  /** @var int|null $yearsWithTeam */
  #[Optional('years_with_team', nullable: true)]
  public ?int $yearsWithTeam;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string|null $licenseNumber
  * @param list<string>|null $qualifications
  * @param null|MedicalSpecialty|value-of<MedicalSpecialty> $specialty
  * @param string|null $teamID
  * @param int|null $yearsWithTeam
  *
  * @return self
 */
  public static function with(
    ?string $licenseNumber = null,
    ?array $qualifications = null,
    null|MedicalSpecialty|string $specialty = null,
    ?string $teamID = null,
    ?int $yearsWithTeam = null,
  ): self {
    $self = new self;

    null !== $licenseNumber && $self['licenseNumber'] = $licenseNumber;
    null !== $qualifications && $self['qualifications'] = $qualifications;
    null !== $specialty && $self['specialty'] = $specialty;
    null !== $teamID && $self['teamID'] = $teamID;
    null !== $yearsWithTeam && $self['yearsWithTeam'] = $yearsWithTeam;

    return $self;
  }

  /**
  * @param string|null $licenseNumber
  *
  * @return self
 */
  public function withLicenseNumber(?string $licenseNumber): self {
    $self = clone $this;
    $self['licenseNumber'] = $licenseNumber;
    return $self;
  }

  /**
  * @param list<string>|null $qualifications
  *
  * @return self
 */
  public function withQualifications(?array $qualifications): self {
    $self = clone $this;
    $self['qualifications'] = $qualifications;
    return $self;
  }

  /**
  * Medical staff specialties.
  *
  * @param null|MedicalSpecialty|value-of<MedicalSpecialty> $specialty
  *
  * @return self
 */
  public function withSpecialty(null|MedicalSpecialty|string $specialty): self {
    $self = clone $this;
    $self['specialty'] = $specialty;
    return $self;
  }

  /**
  * @param string|null $teamID
  *
  * @return self
 */
  public function withTeamID(?string $teamID): self {
    $self = clone $this;
    $self['teamID'] = $teamID;
    return $self;
  }

  /**
  * @param int|null $yearsWithTeam
  *
  * @return self
 */
  public function withYearsWithTeam(?int $yearsWithTeam): self {
    $self = clone $this;
    $self['yearsWithTeam'] = $yearsWithTeam;
    return $self;
  }
}
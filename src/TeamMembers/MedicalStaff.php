<?php

declare(strict_types=1);

namespace Believe\TeamMembers;

use Believe\Core\Attributes\Required;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\TeamMembers\MedicalStaff\MemberType;

/**
  * Full medical staff model with ID.
  *
  * @phpstan-type MedicalStaffShape = array{
  *   id: string,
  *   characterID: string,
  *   specialty: MedicalSpecialty|value-of<MedicalSpecialty>,
  *   teamID: string,
  *   yearsWithTeam: int,
  *   licenseNumber?: string|null,
  *   memberType?: null|MemberType|value-of<MemberType>,
  *   qualifications?: list<string>|null,
  * }
  *
 */
final class MedicalStaff implements BaseModel
{
  /** @use SdkModel<MedicalStaffShape> */
  use SdkModel;

  /**
  * Unique identifier for this team membership
  *
  * @var string $id
 */
  #[Required]
  public string $id;

  /**
  * ID of the character (references /characters/{id})
  *
  * @var string $characterID
 */
  #[Required('character_id')]
  public string $characterID;

  /**
  * Medical specialty
  *
  * @var value-of<MedicalSpecialty> $specialty
 */
  #[Required(enum: MedicalSpecialty::class)]
  public string $specialty;

  /**
  * ID of the team they belong to
  *
  * @var string $teamID
 */
  #[Required('team_id')]
  public string $teamID;

  /**
  * Number of years with the current team
  *
  * @var int $yearsWithTeam
 */
  #[Required('years_with_team')]
  public int $yearsWithTeam;

  /**
  * Professional license number
  *
  * @var string|null $licenseNumber
 */
  #[Optional('license_number', nullable: true)]
  public ?string $licenseNumber;

  /**
  * Discriminator field indicating this is medical staff
  *
  * @var value-of<MemberType>|null $memberType
 */
  #[Optional('member_type', enum: MemberType::class)]
  public ?string $memberType;

  /**
  * Medical qualifications and degrees
  *
  * @var list<string>|null $qualifications
 */
  #[Optional(list: 'string')]
  public ?array $qualifications;

  /**
  * `new MedicalStaff()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * MedicalStaff::with(
  *   id: ..., characterID: ..., specialty: ..., teamID: ..., yearsWithTeam: ...
  * )
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new MedicalStaff)
  *   ->withID(...)
  *   ->withCharacterID(...)
  *   ->withSpecialty(...)
  *   ->withTeamID(...)
  *   ->withYearsWithTeam(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $id
  * @param string $characterID
  * @param MedicalSpecialty|value-of<MedicalSpecialty> $specialty
  * @param string $teamID
  * @param int $yearsWithTeam
  * @param string|null $licenseNumber
  * @param null|MemberType|value-of<MemberType> $memberType
  * @param list<string>|null $qualifications
  *
  * @return self
 */
  public static function with(
    string $id,
    string $characterID,
    MedicalSpecialty|string $specialty,
    string $teamID,
    int $yearsWithTeam,
    ?string $licenseNumber = null,
    MemberType|string $memberType = null,
    array $qualifications = null,
  ): self {
    $self = new self;

    $self['id'] = $id;
    $self['characterID'] = $characterID;
    $self['specialty'] = $specialty;
    $self['teamID'] = $teamID;
    $self['yearsWithTeam'] = $yearsWithTeam;

    null !== $licenseNumber && $self['licenseNumber'] = $licenseNumber;
    null !== $memberType && $self['memberType'] = $memberType;
    null !== $qualifications && $self['qualifications'] = $qualifications;

    return $self;
  }

  /**
  * Unique identifier for this team membership
  *
  * @param string $id
  *
  * @return self
 */
  public function withID(string $id): self {
    $self = clone $this;
    $self['id'] = $id;
    return $self;
  }

  /**
  * ID of the character (references /characters/{id})
  *
  * @param string $characterID
  *
  * @return self
 */
  public function withCharacterID(string $characterID): self {
    $self = clone $this;
    $self['characterID'] = $characterID;
    return $self;
  }

  /**
  * Medical specialty
  *
  * @param MedicalSpecialty|value-of<MedicalSpecialty> $specialty
  *
  * @return self
 */
  public function withSpecialty(MedicalSpecialty|string $specialty): self {
    $self = clone $this;
    $self['specialty'] = $specialty;
    return $self;
  }

  /**
  * ID of the team they belong to
  *
  * @param string $teamID
  *
  * @return self
 */
  public function withTeamID(string $teamID): self {
    $self = clone $this;
    $self['teamID'] = $teamID;
    return $self;
  }

  /**
  * Number of years with the current team
  *
  * @param int $yearsWithTeam
  *
  * @return self
 */
  public function withYearsWithTeam(int $yearsWithTeam): self {
    $self = clone $this;
    $self['yearsWithTeam'] = $yearsWithTeam;
    return $self;
  }

  /**
  * Professional license number
  *
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
  * Discriminator field indicating this is medical staff
  *
  * @param MemberType|value-of<MemberType> $memberType
  *
  * @return self
 */
  public function withMemberType(MemberType|string $memberType): self {
    $self = clone $this;
    $self['memberType'] = $memberType;
    return $self;
  }

  /**
  * Medical qualifications and degrees
  *
  * @param list<string> $qualifications
  *
  * @return self
 */
  public function withQualifications(array $qualifications): self {
    $self = clone $this;
    $self['qualifications'] = $qualifications;
    return $self;
  }
}
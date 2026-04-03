<?php

declare(strict_types=1);

namespace Believe\TeamMembers\TeamMemberCreateParams\Member;

use Believe\Core\Attributes\Required;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\TeamMembers\CoachSpecialty;
use Believe\TeamMembers\TeamMemberCreateParams\Member\CoachBase\MemberType;

/**
  * A coach or coaching staff member.
  *
  * @phpstan-type CoachBaseShape = array{
  *   characterID: string,
  *   specialty: CoachSpecialty|value-of<CoachSpecialty>,
  *   teamID: string,
  *   yearsWithTeam: int,
  *   certifications?: list<string>|null,
  *   memberType?: null|MemberType|value-of<MemberType>,
  *   winRate?: float|null,
  * }
  *
 */
final class CoachBase implements BaseModel
{
  /** @use SdkModel<CoachBaseShape> */
  use SdkModel;

  /**
  * ID of the character (references /characters/{id})
  *
  * @var string $characterID
 */
  #[Required('character_id')]
  public string $characterID;

  /**
  * Coaching specialty/role
  *
  * @var value-of<CoachSpecialty> $specialty
 */
  #[Required(enum: CoachSpecialty::class)]
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
  * Coaching certifications and licenses
  *
  * @var list<string>|null $certifications
 */
  #[Optional(list: 'string')]
  public ?array $certifications;

  /**
  * Discriminator field indicating this is a coach
  *
  * @var value-of<MemberType>|null $memberType
 */
  #[Optional('member_type', enum: MemberType::class)]
  public ?string $memberType;

  /**
  * Career win rate (0.0 to 1.0)
  *
  * @var float|null $winRate
 */
  #[Optional('win_rate', nullable: true)]
  public ?float $winRate;

  /**
  * `new CoachBase()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * CoachBase::with(
  *   characterID: ..., specialty: ..., teamID: ..., yearsWithTeam: ...
  * )
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new CoachBase)
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
  * @param string $characterID
  * @param CoachSpecialty|value-of<CoachSpecialty> $specialty
  * @param string $teamID
  * @param int $yearsWithTeam
  * @param list<string>|null $certifications
  * @param null|MemberType|value-of<MemberType> $memberType
  * @param float|null $winRate
  *
  * @return self
 */
  public static function with(
    string $characterID,
    CoachSpecialty|string $specialty,
    string $teamID,
    int $yearsWithTeam,
    array $certifications = null,
    MemberType|string $memberType = null,
    ?float $winRate = null,
  ): self {
    $self = new self;

    $self['characterID'] = $characterID;
    $self['specialty'] = $specialty;
    $self['teamID'] = $teamID;
    $self['yearsWithTeam'] = $yearsWithTeam;

    null !== $certifications && $self['certifications'] = $certifications;
    null !== $memberType && $self['memberType'] = $memberType;
    null !== $winRate && $self['winRate'] = $winRate;

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
  * Coaching specialty/role
  *
  * @param CoachSpecialty|value-of<CoachSpecialty> $specialty
  *
  * @return self
 */
  public function withSpecialty(CoachSpecialty|string $specialty): self {
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
  * Coaching certifications and licenses
  *
  * @param list<string> $certifications
  *
  * @return self
 */
  public function withCertifications(array $certifications): self {
    $self = clone $this;
    $self['certifications'] = $certifications;
    return $self;
  }

  /**
  * Discriminator field indicating this is a coach
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
  * Career win rate (0.0 to 1.0)
  *
  * @param float|null $winRate
  *
  * @return self
 */
  public function withWinRate(?float $winRate): self {
    $self = clone $this;
    $self['winRate'] = $winRate;
    return $self;
  }
}
<?php

declare(strict_types=1);

namespace Believe\TeamMembers\TeamMemberUpdateParams\Updates;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\TeamMembers\CoachSpecialty;

/**
  * Update model for coaches.
  *
  * @phpstan-type CoachUpdateShape = array{
  *   certifications?: list<string>|null,
  *   specialty?: null|CoachSpecialty|value-of<CoachSpecialty>,
  *   teamID?: string|null,
  *   winRate?: float|null,
  *   yearsWithTeam?: int|null,
  * }
  *
 */
final class CoachUpdate implements BaseModel
{
  /** @use SdkModel<CoachUpdateShape> */
  use SdkModel;

  /** @var list<string>|null $certifications */
  #[Optional(list: 'string', nullable: true)]
  public ?array $certifications;

  /**
  * Coaching specialties.
  *
  * @var value-of<CoachSpecialty>|null $specialty
 */
  #[Optional(enum: CoachSpecialty::class, nullable: true)]
  public ?string $specialty;

  /** @var string|null $teamID */
  #[Optional('team_id', nullable: true)]
  public ?string $teamID;

  /** @var float|null $winRate */
  #[Optional('win_rate', nullable: true)]
  public ?float $winRate;

  /** @var int|null $yearsWithTeam */
  #[Optional('years_with_team', nullable: true)]
  public ?int $yearsWithTeam;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param list<string>|null $certifications
  * @param null|CoachSpecialty|value-of<CoachSpecialty> $specialty
  * @param string|null $teamID
  * @param float|null $winRate
  * @param int|null $yearsWithTeam
  *
  * @return self
 */
  public static function with(
    ?array $certifications = null,
    null|CoachSpecialty|string $specialty = null,
    ?string $teamID = null,
    ?float $winRate = null,
    ?int $yearsWithTeam = null,
  ): self {
    $self = new self;

    null !== $certifications && $self['certifications'] = $certifications;
    null !== $specialty && $self['specialty'] = $specialty;
    null !== $teamID && $self['teamID'] = $teamID;
    null !== $winRate && $self['winRate'] = $winRate;
    null !== $yearsWithTeam && $self['yearsWithTeam'] = $yearsWithTeam;

    return $self;
  }

  /**
  * @param list<string>|null $certifications
  *
  * @return self
 */
  public function withCertifications(?array $certifications): self {
    $self = clone $this;
    $self['certifications'] = $certifications;
    return $self;
  }

  /**
  * Coaching specialties.
  *
  * @param null|CoachSpecialty|value-of<CoachSpecialty> $specialty
  *
  * @return self
 */
  public function withSpecialty(null|CoachSpecialty|string $specialty): self {
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
  * @param float|null $winRate
  *
  * @return self
 */
  public function withWinRate(?float $winRate): self {
    $self = clone $this;
    $self['winRate'] = $winRate;
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
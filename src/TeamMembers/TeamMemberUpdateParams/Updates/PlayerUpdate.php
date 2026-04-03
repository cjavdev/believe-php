<?php

declare(strict_types=1);

namespace Believe\TeamMembers\TeamMemberUpdateParams\Updates;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\TeamMembers\Position;

/**
  * Update model for players.
  *
  * @phpstan-type PlayerUpdateShape = array{
  *   assists?: int|null,
  *   goalsScored?: int|null,
  *   isCaptain?: bool|null,
  *   jerseyNumber?: int|null,
  *   position?: null|Position|value-of<Position>,
  *   teamID?: string|null,
  *   yearsWithTeam?: int|null,
  * }
  *
 */
final class PlayerUpdate implements BaseModel
{
  /** @use SdkModel<PlayerUpdateShape> */
  use SdkModel;

  /** @var int|null $assists */
  #[Optional(nullable: true)]
  public ?int $assists;

  /** @var int|null $goalsScored */
  #[Optional('goals_scored', nullable: true)]
  public ?int $goalsScored;

  /** @var bool|null $isCaptain */
  #[Optional('is_captain', nullable: true)]
  public ?bool $isCaptain;

  /** @var int|null $jerseyNumber */
  #[Optional('jersey_number', nullable: true)]
  public ?int $jerseyNumber;

  /**
  * Football positions for players.
  *
  * @var value-of<Position>|null $position
 */
  #[Optional(enum: Position::class, nullable: true)]
  public ?string $position;

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
  * @param int|null $assists
  * @param int|null $goalsScored
  * @param bool|null $isCaptain
  * @param int|null $jerseyNumber
  * @param null|Position|value-of<Position> $position
  * @param string|null $teamID
  * @param int|null $yearsWithTeam
  *
  * @return self
 */
  public static function with(
    ?int $assists = null,
    ?int $goalsScored = null,
    ?bool $isCaptain = null,
    ?int $jerseyNumber = null,
    null|Position|string $position = null,
    ?string $teamID = null,
    ?int $yearsWithTeam = null,
  ): self {
    $self = new self;

    null !== $assists && $self['assists'] = $assists;
    null !== $goalsScored && $self['goalsScored'] = $goalsScored;
    null !== $isCaptain && $self['isCaptain'] = $isCaptain;
    null !== $jerseyNumber && $self['jerseyNumber'] = $jerseyNumber;
    null !== $position && $self['position'] = $position;
    null !== $teamID && $self['teamID'] = $teamID;
    null !== $yearsWithTeam && $self['yearsWithTeam'] = $yearsWithTeam;

    return $self;
  }

  /**
  * @param int|null $assists
  *
  * @return self
 */
  public function withAssists(?int $assists): self {
    $self = clone $this;
    $self['assists'] = $assists;
    return $self;
  }

  /**
  * @param int|null $goalsScored
  *
  * @return self
 */
  public function withGoalsScored(?int $goalsScored): self {
    $self = clone $this;
    $self['goalsScored'] = $goalsScored;
    return $self;
  }

  /**
  * @param bool|null $isCaptain
  *
  * @return self
 */
  public function withIsCaptain(?bool $isCaptain): self {
    $self = clone $this;
    $self['isCaptain'] = $isCaptain;
    return $self;
  }

  /**
  * @param int|null $jerseyNumber
  *
  * @return self
 */
  public function withJerseyNumber(?int $jerseyNumber): self {
    $self = clone $this;
    $self['jerseyNumber'] = $jerseyNumber;
    return $self;
  }

  /**
  * Football positions for players.
  *
  * @param null|Position|value-of<Position> $position
  *
  * @return self
 */
  public function withPosition(null|Position|string $position): self {
    $self = clone $this;
    $self['position'] = $position;
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
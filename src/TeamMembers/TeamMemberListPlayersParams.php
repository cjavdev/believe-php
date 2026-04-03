<?php

declare(strict_types=1);

namespace Believe\TeamMembers;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Get only players (filtered subset of team members).
  * @see Believe\Services\TeamMembersService::listPlayers()
  *
  * @phpstan-type TeamMemberListPlayersParamsShape = array{
  *   limit?: int|null,
  *   position?: null|Position|value-of<Position>,
  *   skip?: int|null,
  *   teamID?: string|null,
  * }
  *
 */
final class TeamMemberListPlayersParams implements BaseModel
{
  /** @use SdkModel<TeamMemberListPlayersParamsShape> */
  use SdkModel;
  use SdkParams;

  /**
  * Maximum number of items to return (max: 100)
  *
  * @var int|null $limit
 */
  #[Optional]
  public ?int $limit;

  /**
  * Filter by position
  *
  * @var value-of<Position>|null $position
 */
  #[Optional(enum: Position::class, nullable: true)]
  public ?string $position;

  /**
  * Number of items to skip (offset)
  *
  * @var int|null $skip
 */
  #[Optional]
  public ?int $skip;

  /**
  * Filter by team ID
  *
  * @var string|null $teamID
 */
  #[Optional(nullable: true)]
  public ?string $teamID;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param int|null $limit
  * @param null|Position|value-of<Position> $position
  * @param int|null $skip
  * @param string|null $teamID
  *
  * @return self
 */
  public static function with(
    int $limit = null,
    null|Position|string $position = null,
    int $skip = null,
    ?string $teamID = null,
  ): self {
    $self = new self;

    null !== $limit && $self['limit'] = $limit;
    null !== $position && $self['position'] = $position;
    null !== $skip && $self['skip'] = $skip;
    null !== $teamID && $self['teamID'] = $teamID;

    return $self;
  }

  /**
  * Maximum number of items to return (max: 100)
  *
  * @param int $limit
  *
  * @return self
 */
  public function withLimit(int $limit): self {
    $self = clone $this;
    $self['limit'] = $limit;
    return $self;
  }

  /**
  * Filter by position
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
  * Number of items to skip (offset)
  *
  * @param int $skip
  *
  * @return self
 */
  public function withSkip(int $skip): self {
    $self = clone $this;
    $self['skip'] = $skip;
    return $self;
  }

  /**
  * Filter by team ID
  *
  * @param string|null $teamID
  *
  * @return self
 */
  public function withTeamID(?string $teamID): self {
    $self = clone $this;
    $self['teamID'] = $teamID;
    return $self;
  }
}
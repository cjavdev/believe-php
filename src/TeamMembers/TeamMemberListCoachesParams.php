<?php

declare(strict_types=1);

namespace Believe\TeamMembers;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Get only coaches (filtered subset of team members).
  * @see Believe\Services\TeamMembersService::listCoaches()
  *
  * @phpstan-type TeamMemberListCoachesParamsShape = array{
  *   limit?: int|null,
  *   skip?: int|null,
  *   specialty?: null|CoachSpecialty|value-of<CoachSpecialty>,
  *   teamID?: string|null,
  * }
  *
 */
final class TeamMemberListCoachesParams implements BaseModel
{
  /** @use SdkModel<TeamMemberListCoachesParamsShape> */
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
  * Number of items to skip (offset)
  *
  * @var int|null $skip
 */
  #[Optional]
  public ?int $skip;

  /**
  * Filter by specialty
  *
  * @var value-of<CoachSpecialty>|null $specialty
 */
  #[Optional(enum: CoachSpecialty::class, nullable: true)]
  public ?string $specialty;

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
  * @param int|null $skip
  * @param null|CoachSpecialty|value-of<CoachSpecialty> $specialty
  * @param string|null $teamID
  *
  * @return self
 */
  public static function with(
    int $limit = null,
    int $skip = null,
    null|CoachSpecialty|string $specialty = null,
    ?string $teamID = null,
  ): self {
    $self = new self;

    null !== $limit && $self['limit'] = $limit;
    null !== $skip && $self['skip'] = $skip;
    null !== $specialty && $self['specialty'] = $specialty;
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
  * Filter by specialty
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
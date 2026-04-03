<?php

declare(strict_types=1);

namespace Believe\Teams;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Get a paginated list of all teams with optional filtering by league or culture score.
  * @see Believe\Services\TeamsService::list()
  *
  * @phpstan-type TeamListParamsShape = array{
  *   league?: null|League|value-of<League>,
  *   limit?: int|null,
  *   minCultureScore?: int|null,
  *   skip?: int|null,
  * }
  *
 */
final class TeamListParams implements BaseModel
{
  /** @use SdkModel<TeamListParamsShape> */
  use SdkModel;
  use SdkParams;

  /**
  * Filter by league
  *
  * @var value-of<League>|null $league
 */
  #[Optional(enum: League::class, nullable: true)]
  public ?string $league;

  /**
  * Maximum number of items to return (max: 100)
  *
  * @var int|null $limit
 */
  #[Optional]
  public ?int $limit;

  /**
  * Minimum culture score
  *
  * @var int|null $minCultureScore
 */
  #[Optional(nullable: true)]
  public ?int $minCultureScore;

  /**
  * Number of items to skip (offset)
  *
  * @var int|null $skip
 */
  #[Optional]
  public ?int $skip;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param null|League|value-of<League> $league
  * @param int|null $limit
  * @param int|null $minCultureScore
  * @param int|null $skip
  *
  * @return self
 */
  public static function with(
    null|League|string $league = null,
    int $limit = null,
    ?int $minCultureScore = null,
    int $skip = null,
  ): self {
    $self = new self;

    null !== $league && $self['league'] = $league;
    null !== $limit && $self['limit'] = $limit;
    null !== $minCultureScore && $self['minCultureScore'] = $minCultureScore;
    null !== $skip && $self['skip'] = $skip;

    return $self;
  }

  /**
  * Filter by league
  *
  * @param null|League|value-of<League> $league
  *
  * @return self
 */
  public function withLeague(null|League|string $league): self {
    $self = clone $this;
    $self['league'] = $league;
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
  * Minimum culture score
  *
  * @param int|null $minCultureScore
  *
  * @return self
 */
  public function withMinCultureScore(?int $minCultureScore): self {
    $self = clone $this;
    $self['minCultureScore'] = $minCultureScore;
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
}
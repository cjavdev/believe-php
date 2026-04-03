<?php

declare(strict_types=1);

namespace Believe\Matches;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Get a paginated list of all matches with optional filtering.
  * @see Believe\Services\MatchesService::list()
  *
  * @phpstan-type MatchListParamsShape = array{
  *   limit?: int|null,
  *   matchType?: null|MatchType|value-of<MatchType>,
  *   result?: null|MatchResult|value-of<MatchResult>,
  *   skip?: int|null,
  *   teamID?: string|null,
  * }
  *
 */
final class MatchListParams implements BaseModel
{
  /** @use SdkModel<MatchListParamsShape> */
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
  * Filter by match type
  *
  * @var value-of<MatchType>|null $matchType
 */
  #[Optional(enum: MatchType::class, nullable: true)]
  public ?string $matchType;

  /**
  * Filter by result
  *
  * @var value-of<MatchResult>|null $result
 */
  #[Optional(enum: MatchResult::class, nullable: true)]
  public ?string $result;

  /**
  * Number of items to skip (offset)
  *
  * @var int|null $skip
 */
  #[Optional]
  public ?int $skip;

  /**
  * Filter by team (home or away)
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
  * @param null|MatchType|value-of<MatchType> $matchType
  * @param null|MatchResult|value-of<MatchResult> $result
  * @param int|null $skip
  * @param string|null $teamID
  *
  * @return self
 */
  public static function with(
    int $limit = null,
    null|MatchType|string $matchType = null,
    null|MatchResult|string $result = null,
    int $skip = null,
    ?string $teamID = null,
  ): self {
    $self = new self;

    null !== $limit && $self['limit'] = $limit;
    null !== $matchType && $self['matchType'] = $matchType;
    null !== $result && $self['result'] = $result;
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
  * Filter by match type
  *
  * @param null|MatchType|value-of<MatchType> $matchType
  *
  * @return self
 */
  public function withMatchType(null|MatchType|string $matchType): self {
    $self = clone $this;
    $self['matchType'] = $matchType;
    return $self;
  }

  /**
  * Filter by result
  *
  * @param null|MatchResult|value-of<MatchResult> $result
  *
  * @return self
 */
  public function withResult(null|MatchResult|string $result): self {
    $self = clone $this;
    $self['result'] = $result;
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
  * Filter by team (home or away)
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
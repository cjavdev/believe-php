<?php

declare(strict_types=1);

namespace Believe\Matches;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Get a paginated list of all matches with optional filtering.
 *
 * @see Believe\Services\MatchesService::list()
 *
 * @phpstan-type MatchListParamsShape = array{
 *   limit?: int|null,
 *   matchType?: null|MatchType|value-of<MatchType>,
 *   result?: null|MatchResult|value-of<MatchResult>,
 *   skip?: int|null,
 *   teamID?: string|null,
 * }
 */
final class MatchListParams implements BaseModel
{
    /** @use SdkModel<MatchListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Maximum number of items to return (max: 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter by match type.
     *
     * @var value-of<MatchType>|null $matchType
     */
    #[Optional(enum: MatchType::class, nullable: true)]
    public ?string $matchType;

    /**
     * Filter by result.
     *
     * @var value-of<MatchResult>|null $result
     */
    #[Optional(enum: MatchResult::class, nullable: true)]
    public ?string $result;

    /**
     * Number of items to skip (offset).
     */
    #[Optional]
    public ?int $skip;

    /**
     * Filter by team (home or away).
     */
    #[Optional(nullable: true)]
    public ?string $teamID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param MatchType|value-of<MatchType>|null $matchType
     * @param MatchResult|value-of<MatchResult>|null $result
     */
    public static function with(
        ?int $limit = null,
        MatchType|string|null $matchType = null,
        MatchResult|string|null $result = null,
        ?int $skip = null,
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
     * Maximum number of items to return (max: 100).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter by match type.
     *
     * @param MatchType|value-of<MatchType>|null $matchType
     */
    public function withMatchType(MatchType|string|null $matchType): self
    {
        $self = clone $this;
        $self['matchType'] = $matchType;

        return $self;
    }

    /**
     * Filter by result.
     *
     * @param MatchResult|value-of<MatchResult>|null $result
     */
    public function withResult(MatchResult|string|null $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }

    /**
     * Number of items to skip (offset).
     */
    public function withSkip(int $skip): self
    {
        $self = clone $this;
        $self['skip'] = $skip;

        return $self;
    }

    /**
     * Filter by team (home or away).
     */
    public function withTeamID(?string $teamID): self
    {
        $self = clone $this;
        $self['teamID'] = $teamID;

        return $self;
    }
}

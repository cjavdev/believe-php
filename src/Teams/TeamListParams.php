<?php

declare(strict_types=1);

namespace Believe\Teams;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Get a paginated list of all teams with optional filtering by league or culture score.
 *
 * @see Believe\Services\TeamsService::list()
 *
 * @phpstan-type TeamListParamsShape = array{
 *   league?: null|League|value-of<League>,
 *   limit?: int|null,
 *   minCultureScore?: int|null,
 *   skip?: int|null,
 * }
 */
final class TeamListParams implements BaseModel
{
    /** @use SdkModel<TeamListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by league.
     *
     * @var value-of<League>|null $league
     */
    #[Optional(enum: League::class, nullable: true)]
    public ?string $league;

    /**
     * Maximum number of items to return (max: 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Minimum culture score.
     */
    #[Optional(nullable: true)]
    public ?int $minCultureScore;

    /**
     * Number of items to skip (offset).
     */
    #[Optional]
    public ?int $skip;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param League|value-of<League>|null $league
     */
    public static function with(
        League|string|null $league = null,
        ?int $limit = null,
        ?int $minCultureScore = null,
        ?int $skip = null,
    ): self {
        $self = new self;

        null !== $league && $self['league'] = $league;
        null !== $limit && $self['limit'] = $limit;
        null !== $minCultureScore && $self['minCultureScore'] = $minCultureScore;
        null !== $skip && $self['skip'] = $skip;

        return $self;
    }

    /**
     * Filter by league.
     *
     * @param League|value-of<League>|null $league
     */
    public function withLeague(League|string|null $league): self
    {
        $self = clone $this;
        $self['league'] = $league;

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
     * Minimum culture score.
     */
    public function withMinCultureScore(?int $minCultureScore): self
    {
        $self = clone $this;
        $self['minCultureScore'] = $minCultureScore;

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
}

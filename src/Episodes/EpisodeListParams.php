<?php

declare(strict_types=1);

namespace Believe\Episodes;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Get a paginated list of all Ted Lasso episodes with optional filtering by season.
 *
 * @see Believe\Services\EpisodesService::list()
 *
 * @phpstan-type EpisodeListParamsShape = array{
 *   characterFocus?: string|null,
 *   limit?: int|null,
 *   season?: int|null,
 *   skip?: int|null,
 * }
 */
final class EpisodeListParams implements BaseModel
{
    /** @use SdkModel<EpisodeListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by character focus (character ID).
     */
    #[Optional(nullable: true)]
    public ?string $characterFocus;

    /**
     * Maximum number of items to return (max: 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter by season.
     */
    #[Optional(nullable: true)]
    public ?int $season;

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
     */
    public static function with(
        ?string $characterFocus = null,
        ?int $limit = null,
        ?int $season = null,
        ?int $skip = null,
    ): self {
        $self = new self;

        null !== $characterFocus && $self['characterFocus'] = $characterFocus;
        null !== $limit && $self['limit'] = $limit;
        null !== $season && $self['season'] = $season;
        null !== $skip && $self['skip'] = $skip;

        return $self;
    }

    /**
     * Filter by character focus (character ID).
     */
    public function withCharacterFocus(?string $characterFocus): self
    {
        $self = clone $this;
        $self['characterFocus'] = $characterFocus;

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
     * Filter by season.
     */
    public function withSeason(?int $season): self
    {
        $self = clone $this;
        $self['season'] = $season;

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

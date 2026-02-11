<?php

declare(strict_types=1);

namespace Believe\Episodes;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Update specific fields of an existing episode.
 *
 * @see Believe\Services\EpisodesService::update()
 *
 * @phpstan-type EpisodeUpdateParamsShape = array{
 *   airDate?: string|null,
 *   biscuitsWithBossMoment?: string|null,
 *   characterFocus?: list<string>|null,
 *   director?: string|null,
 *   episodeNumber?: int|null,
 *   mainTheme?: string|null,
 *   memorableMoments?: list<string>|null,
 *   runtimeMinutes?: int|null,
 *   season?: int|null,
 *   synopsis?: string|null,
 *   tedWisdom?: string|null,
 *   title?: string|null,
 *   usViewersMillions?: float|null,
 *   viewerRating?: float|null,
 *   writer?: string|null,
 * }
 */
final class EpisodeUpdateParams implements BaseModel
{
    /** @use SdkModel<EpisodeUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional('air_date', nullable: true)]
    public ?string $airDate;

    #[Optional('biscuits_with_boss_moment', nullable: true)]
    public ?string $biscuitsWithBossMoment;

    /** @var list<string>|null $characterFocus */
    #[Optional('character_focus', list: 'string', nullable: true)]
    public ?array $characterFocus;

    #[Optional(nullable: true)]
    public ?string $director;

    #[Optional('episode_number', nullable: true)]
    public ?int $episodeNumber;

    #[Optional('main_theme', nullable: true)]
    public ?string $mainTheme;

    /** @var list<string>|null $memorableMoments */
    #[Optional('memorable_moments', list: 'string', nullable: true)]
    public ?array $memorableMoments;

    #[Optional('runtime_minutes', nullable: true)]
    public ?int $runtimeMinutes;

    #[Optional(nullable: true)]
    public ?int $season;

    #[Optional(nullable: true)]
    public ?string $synopsis;

    #[Optional('ted_wisdom', nullable: true)]
    public ?string $tedWisdom;

    #[Optional(nullable: true)]
    public ?string $title;

    #[Optional('us_viewers_millions', nullable: true)]
    public ?float $usViewersMillions;

    #[Optional('viewer_rating', nullable: true)]
    public ?float $viewerRating;

    #[Optional(nullable: true)]
    public ?string $writer;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $characterFocus
     * @param list<string>|null $memorableMoments
     */
    public static function with(
        ?string $airDate = null,
        ?string $biscuitsWithBossMoment = null,
        ?array $characterFocus = null,
        ?string $director = null,
        ?int $episodeNumber = null,
        ?string $mainTheme = null,
        ?array $memorableMoments = null,
        ?int $runtimeMinutes = null,
        ?int $season = null,
        ?string $synopsis = null,
        ?string $tedWisdom = null,
        ?string $title = null,
        ?float $usViewersMillions = null,
        ?float $viewerRating = null,
        ?string $writer = null,
    ): self {
        $self = new self;

        null !== $airDate && $self['airDate'] = $airDate;
        null !== $biscuitsWithBossMoment && $self['biscuitsWithBossMoment'] = $biscuitsWithBossMoment;
        null !== $characterFocus && $self['characterFocus'] = $characterFocus;
        null !== $director && $self['director'] = $director;
        null !== $episodeNumber && $self['episodeNumber'] = $episodeNumber;
        null !== $mainTheme && $self['mainTheme'] = $mainTheme;
        null !== $memorableMoments && $self['memorableMoments'] = $memorableMoments;
        null !== $runtimeMinutes && $self['runtimeMinutes'] = $runtimeMinutes;
        null !== $season && $self['season'] = $season;
        null !== $synopsis && $self['synopsis'] = $synopsis;
        null !== $tedWisdom && $self['tedWisdom'] = $tedWisdom;
        null !== $title && $self['title'] = $title;
        null !== $usViewersMillions && $self['usViewersMillions'] = $usViewersMillions;
        null !== $viewerRating && $self['viewerRating'] = $viewerRating;
        null !== $writer && $self['writer'] = $writer;

        return $self;
    }

    public function withAirDate(?string $airDate): self
    {
        $self = clone $this;
        $self['airDate'] = $airDate;

        return $self;
    }

    public function withBiscuitsWithBossMoment(
        ?string $biscuitsWithBossMoment
    ): self {
        $self = clone $this;
        $self['biscuitsWithBossMoment'] = $biscuitsWithBossMoment;

        return $self;
    }

    /**
     * @param list<string>|null $characterFocus
     */
    public function withCharacterFocus(?array $characterFocus): self
    {
        $self = clone $this;
        $self['characterFocus'] = $characterFocus;

        return $self;
    }

    public function withDirector(?string $director): self
    {
        $self = clone $this;
        $self['director'] = $director;

        return $self;
    }

    public function withEpisodeNumber(?int $episodeNumber): self
    {
        $self = clone $this;
        $self['episodeNumber'] = $episodeNumber;

        return $self;
    }

    public function withMainTheme(?string $mainTheme): self
    {
        $self = clone $this;
        $self['mainTheme'] = $mainTheme;

        return $self;
    }

    /**
     * @param list<string>|null $memorableMoments
     */
    public function withMemorableMoments(?array $memorableMoments): self
    {
        $self = clone $this;
        $self['memorableMoments'] = $memorableMoments;

        return $self;
    }

    public function withRuntimeMinutes(?int $runtimeMinutes): self
    {
        $self = clone $this;
        $self['runtimeMinutes'] = $runtimeMinutes;

        return $self;
    }

    public function withSeason(?int $season): self
    {
        $self = clone $this;
        $self['season'] = $season;

        return $self;
    }

    public function withSynopsis(?string $synopsis): self
    {
        $self = clone $this;
        $self['synopsis'] = $synopsis;

        return $self;
    }

    public function withTedWisdom(?string $tedWisdom): self
    {
        $self = clone $this;
        $self['tedWisdom'] = $tedWisdom;

        return $self;
    }

    public function withTitle(?string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    public function withUsViewersMillions(?float $usViewersMillions): self
    {
        $self = clone $this;
        $self['usViewersMillions'] = $usViewersMillions;

        return $self;
    }

    public function withViewerRating(?float $viewerRating): self
    {
        $self = clone $this;
        $self['viewerRating'] = $viewerRating;

        return $self;
    }

    public function withWriter(?string $writer): self
    {
        $self = clone $this;
        $self['writer'] = $writer;

        return $self;
    }
}

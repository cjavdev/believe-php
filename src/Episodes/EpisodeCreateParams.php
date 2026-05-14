<?php

declare(strict_types=1);

namespace Believe\Episodes;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Add a new episode to the series.
 *
 * @see Believe\Services\EpisodesService::create()
 *
 * @phpstan-type EpisodeCreateParamsShape = array{
 *   airDate: string,
 *   characterFocus: list<string>,
 *   director: string,
 *   episodeNumber: int,
 *   mainTheme: string,
 *   runtimeMinutes: int,
 *   season: int,
 *   synopsis: string,
 *   tedWisdom: string,
 *   title: string,
 *   writer: string,
 *   biscuitsWithBossMoment?: string|null,
 *   memorableMoments?: list<string>|null,
 *   usViewersMillions?: float|null,
 *   viewerRating?: float|null,
 * }
 */
final class EpisodeCreateParams implements BaseModel
{
    /** @use SdkModel<EpisodeCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Original air date.
     */
    #[Required('air_date')]
    public string $airDate;

    /**
     * Characters with significant development.
     *
     * @var list<string> $characterFocus
     */
    #[Required('character_focus', list: 'string')]
    public array $characterFocus;

    /**
     * Episode director.
     */
    #[Required]
    public string $director;

    /**
     * Episode number within season.
     */
    #[Required('episode_number')]
    public int $episodeNumber;

    /**
     * Central theme of the episode.
     */
    #[Required('main_theme')]
    public string $mainTheme;

    /**
     * Episode runtime in minutes.
     */
    #[Required('runtime_minutes')]
    public int $runtimeMinutes;

    /**
     * Season number.
     */
    #[Required]
    public int $season;

    /**
     * Brief plot synopsis.
     */
    #[Required]
    public string $synopsis;

    /**
     * Key piece of Ted wisdom from the episode.
     */
    #[Required('ted_wisdom')]
    public string $tedWisdom;

    /**
     * Episode title.
     */
    #[Required]
    public string $title;

    /**
     * Episode writer(s).
     */
    #[Required]
    public string $writer;

    /**
     * Notable biscuits with the boss scene.
     */
    #[Optional('biscuits_with_boss_moment', nullable: true)]
    public ?string $biscuitsWithBossMoment;

    /**
     * Standout moments from the episode.
     *
     * @var list<string>|null $memorableMoments
     */
    #[Optional('memorable_moments', list: 'string')]
    public ?array $memorableMoments;

    /**
     * US viewership in millions.
     */
    #[Optional('us_viewers_millions', nullable: true)]
    public ?float $usViewersMillions;

    /**
     * Viewer rating out of 10.
     */
    #[Optional('viewer_rating', nullable: true)]
    public ?float $viewerRating;

    /**
     * `new EpisodeCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EpisodeCreateParams::with(
     *   airDate: ...,
     *   characterFocus: ...,
     *   director: ...,
     *   episodeNumber: ...,
     *   mainTheme: ...,
     *   runtimeMinutes: ...,
     *   season: ...,
     *   synopsis: ...,
     *   tedWisdom: ...,
     *   title: ...,
     *   writer: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EpisodeCreateParams)
     *   ->withAirDate(...)
     *   ->withCharacterFocus(...)
     *   ->withDirector(...)
     *   ->withEpisodeNumber(...)
     *   ->withMainTheme(...)
     *   ->withRuntimeMinutes(...)
     *   ->withSeason(...)
     *   ->withSynopsis(...)
     *   ->withTedWisdom(...)
     *   ->withTitle(...)
     *   ->withWriter(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string> $characterFocus
     * @param list<string>|null $memorableMoments
     */
    public static function with(
        string $airDate,
        array $characterFocus,
        string $director,
        int $episodeNumber,
        string $mainTheme,
        int $runtimeMinutes,
        int $season,
        string $synopsis,
        string $tedWisdom,
        string $title,
        string $writer,
        ?string $biscuitsWithBossMoment = null,
        ?array $memorableMoments = null,
        ?float $usViewersMillions = null,
        ?float $viewerRating = null,
    ): self {
        $self = new self;

        $self['airDate'] = $airDate;
        $self['characterFocus'] = $characterFocus;
        $self['director'] = $director;
        $self['episodeNumber'] = $episodeNumber;
        $self['mainTheme'] = $mainTheme;
        $self['runtimeMinutes'] = $runtimeMinutes;
        $self['season'] = $season;
        $self['synopsis'] = $synopsis;
        $self['tedWisdom'] = $tedWisdom;
        $self['title'] = $title;
        $self['writer'] = $writer;

        null !== $biscuitsWithBossMoment && $self['biscuitsWithBossMoment'] = $biscuitsWithBossMoment;
        null !== $memorableMoments && $self['memorableMoments'] = $memorableMoments;
        null !== $usViewersMillions && $self['usViewersMillions'] = $usViewersMillions;
        null !== $viewerRating && $self['viewerRating'] = $viewerRating;

        return $self;
    }

    /**
     * Original air date.
     */
    public function withAirDate(string $airDate): self
    {
        $self = clone $this;
        $self['airDate'] = $airDate;

        return $self;
    }

    /**
     * Characters with significant development.
     *
     * @param list<string> $characterFocus
     */
    public function withCharacterFocus(array $characterFocus): self
    {
        $self = clone $this;
        $self['characterFocus'] = $characterFocus;

        return $self;
    }

    /**
     * Episode director.
     */
    public function withDirector(string $director): self
    {
        $self = clone $this;
        $self['director'] = $director;

        return $self;
    }

    /**
     * Episode number within season.
     */
    public function withEpisodeNumber(int $episodeNumber): self
    {
        $self = clone $this;
        $self['episodeNumber'] = $episodeNumber;

        return $self;
    }

    /**
     * Central theme of the episode.
     */
    public function withMainTheme(string $mainTheme): self
    {
        $self = clone $this;
        $self['mainTheme'] = $mainTheme;

        return $self;
    }

    /**
     * Episode runtime in minutes.
     */
    public function withRuntimeMinutes(int $runtimeMinutes): self
    {
        $self = clone $this;
        $self['runtimeMinutes'] = $runtimeMinutes;

        return $self;
    }

    /**
     * Season number.
     */
    public function withSeason(int $season): self
    {
        $self = clone $this;
        $self['season'] = $season;

        return $self;
    }

    /**
     * Brief plot synopsis.
     */
    public function withSynopsis(string $synopsis): self
    {
        $self = clone $this;
        $self['synopsis'] = $synopsis;

        return $self;
    }

    /**
     * Key piece of Ted wisdom from the episode.
     */
    public function withTedWisdom(string $tedWisdom): self
    {
        $self = clone $this;
        $self['tedWisdom'] = $tedWisdom;

        return $self;
    }

    /**
     * Episode title.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Episode writer(s).
     */
    public function withWriter(string $writer): self
    {
        $self = clone $this;
        $self['writer'] = $writer;

        return $self;
    }

    /**
     * Notable biscuits with the boss scene.
     */
    public function withBiscuitsWithBossMoment(
        ?string $biscuitsWithBossMoment
    ): self {
        $self = clone $this;
        $self['biscuitsWithBossMoment'] = $biscuitsWithBossMoment;

        return $self;
    }

    /**
     * Standout moments from the episode.
     *
     * @param list<string> $memorableMoments
     */
    public function withMemorableMoments(array $memorableMoments): self
    {
        $self = clone $this;
        $self['memorableMoments'] = $memorableMoments;

        return $self;
    }

    /**
     * US viewership in millions.
     */
    public function withUsViewersMillions(?float $usViewersMillions): self
    {
        $self = clone $this;
        $self['usViewersMillions'] = $usViewersMillions;

        return $self;
    }

    /**
     * Viewer rating out of 10.
     */
    public function withViewerRating(?float $viewerRating): self
    {
        $self = clone $this;
        $self['viewerRating'] = $viewerRating;

        return $self;
    }
}

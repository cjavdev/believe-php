<?php

declare(strict_types=1);

namespace Believe\Episodes;

use Believe\Core\Attributes\Required;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Full episode model with ID.
  *
  * @phpstan-type EpisodeShape = array{
  *   id: string,
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
  *
 */
final class Episode implements BaseModel
{
  /** @use SdkModel<EpisodeShape> */
  use SdkModel;

  /**
  * Unique identifier (format: s##e##)
  *
  * @var string $id
 */
  #[Required]
  public string $id;

  /**
  * Original air date
  *
  * @var string $airDate
 */
  #[Required('air_date')]
  public string $airDate;

  /**
  * Characters with significant development
  *
  * @var list<string> $characterFocus
 */
  #[Required('character_focus', list: 'string')]
  public array $characterFocus;

  /**
  * Episode director
  *
  * @var string $director
 */
  #[Required]
  public string $director;

  /**
  * Episode number within season
  *
  * @var int $episodeNumber
 */
  #[Required('episode_number')]
  public int $episodeNumber;

  /**
  * Central theme of the episode
  *
  * @var string $mainTheme
 */
  #[Required('main_theme')]
  public string $mainTheme;

  /**
  * Episode runtime in minutes
  *
  * @var int $runtimeMinutes
 */
  #[Required('runtime_minutes')]
  public int $runtimeMinutes;

  /**
  * Season number
  *
  * @var int $season
 */
  #[Required]
  public int $season;

  /**
  * Brief plot synopsis
  *
  * @var string $synopsis
 */
  #[Required]
  public string $synopsis;

  /**
  * Key piece of Ted wisdom from the episode
  *
  * @var string $tedWisdom
 */
  #[Required('ted_wisdom')]
  public string $tedWisdom;

  /**
  * Episode title
  *
  * @var string $title
 */
  #[Required]
  public string $title;

  /**
  * Episode writer(s)
  *
  * @var string $writer
 */
  #[Required]
  public string $writer;

  /**
  * Notable biscuits with the boss scene
  *
  * @var string|null $biscuitsWithBossMoment
 */
  #[Optional('biscuits_with_boss_moment', nullable: true)]
  public ?string $biscuitsWithBossMoment;

  /**
  * Standout moments from the episode
  *
  * @var list<string>|null $memorableMoments
 */
  #[Optional('memorable_moments', list: 'string')]
  public ?array $memorableMoments;

  /**
  * US viewership in millions
  *
  * @var float|null $usViewersMillions
 */
  #[Optional('us_viewers_millions', nullable: true)]
  public ?float $usViewersMillions;

  /**
  * Viewer rating out of 10
  *
  * @var float|null $viewerRating
 */
  #[Optional('viewer_rating', nullable: true)]
  public ?float $viewerRating;

  /**
  * `new Episode()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * Episode::with(
  *   id: ...,
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
  * (new Episode)
  *   ->withID(...)
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
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $id
  * @param string $airDate
  * @param list<string> $characterFocus
  * @param string $director
  * @param int $episodeNumber
  * @param string $mainTheme
  * @param int $runtimeMinutes
  * @param int $season
  * @param string $synopsis
  * @param string $tedWisdom
  * @param string $title
  * @param string $writer
  * @param string|null $biscuitsWithBossMoment
  * @param list<string>|null $memorableMoments
  * @param float|null $usViewersMillions
  * @param float|null $viewerRating
  *
  * @return self
 */
  public static function with(
    string $id,
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
    array $memorableMoments = null,
    ?float $usViewersMillions = null,
    ?float $viewerRating = null,
  ): self {
    $self = new self;

    $self['id'] = $id;
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
  * Unique identifier (format: s##e##)
  *
  * @param string $id
  *
  * @return self
 */
  public function withID(string $id): self {
    $self = clone $this;
    $self['id'] = $id;
    return $self;
  }

  /**
  * Original air date
  *
  * @param string $airDate
  *
  * @return self
 */
  public function withAirDate(string $airDate): self {
    $self = clone $this;
    $self['airDate'] = $airDate;
    return $self;
  }

  /**
  * Characters with significant development
  *
  * @param list<string> $characterFocus
  *
  * @return self
 */
  public function withCharacterFocus(array $characterFocus): self {
    $self = clone $this;
    $self['characterFocus'] = $characterFocus;
    return $self;
  }

  /**
  * Episode director
  *
  * @param string $director
  *
  * @return self
 */
  public function withDirector(string $director): self {
    $self = clone $this;
    $self['director'] = $director;
    return $self;
  }

  /**
  * Episode number within season
  *
  * @param int $episodeNumber
  *
  * @return self
 */
  public function withEpisodeNumber(int $episodeNumber): self {
    $self = clone $this;
    $self['episodeNumber'] = $episodeNumber;
    return $self;
  }

  /**
  * Central theme of the episode
  *
  * @param string $mainTheme
  *
  * @return self
 */
  public function withMainTheme(string $mainTheme): self {
    $self = clone $this;
    $self['mainTheme'] = $mainTheme;
    return $self;
  }

  /**
  * Episode runtime in minutes
  *
  * @param int $runtimeMinutes
  *
  * @return self
 */
  public function withRuntimeMinutes(int $runtimeMinutes): self {
    $self = clone $this;
    $self['runtimeMinutes'] = $runtimeMinutes;
    return $self;
  }

  /**
  * Season number
  *
  * @param int $season
  *
  * @return self
 */
  public function withSeason(int $season): self {
    $self = clone $this;
    $self['season'] = $season;
    return $self;
  }

  /**
  * Brief plot synopsis
  *
  * @param string $synopsis
  *
  * @return self
 */
  public function withSynopsis(string $synopsis): self {
    $self = clone $this;
    $self['synopsis'] = $synopsis;
    return $self;
  }

  /**
  * Key piece of Ted wisdom from the episode
  *
  * @param string $tedWisdom
  *
  * @return self
 */
  public function withTedWisdom(string $tedWisdom): self {
    $self = clone $this;
    $self['tedWisdom'] = $tedWisdom;
    return $self;
  }

  /**
  * Episode title
  *
  * @param string $title
  *
  * @return self
 */
  public function withTitle(string $title): self {
    $self = clone $this;
    $self['title'] = $title;
    return $self;
  }

  /**
  * Episode writer(s)
  *
  * @param string $writer
  *
  * @return self
 */
  public function withWriter(string $writer): self {
    $self = clone $this;
    $self['writer'] = $writer;
    return $self;
  }

  /**
  * Notable biscuits with the boss scene
  *
  * @param string|null $biscuitsWithBossMoment
  *
  * @return self
 */
  public function withBiscuitsWithBossMoment(
    ?string $biscuitsWithBossMoment
  ): self {
    $self = clone $this;
    $self['biscuitsWithBossMoment'] = $biscuitsWithBossMoment;
    return $self;
  }

  /**
  * Standout moments from the episode
  *
  * @param list<string> $memorableMoments
  *
  * @return self
 */
  public function withMemorableMoments(array $memorableMoments): self {
    $self = clone $this;
    $self['memorableMoments'] = $memorableMoments;
    return $self;
  }

  /**
  * US viewership in millions
  *
  * @param float|null $usViewersMillions
  *
  * @return self
 */
  public function withUsViewersMillions(?float $usViewersMillions): self {
    $self = clone $this;
    $self['usViewersMillions'] = $usViewersMillions;
    return $self;
  }

  /**
  * Viewer rating out of 10
  *
  * @param float|null $viewerRating
  *
  * @return self
 */
  public function withViewerRating(?float $viewerRating): self {
    $self = clone $this;
    $self['viewerRating'] = $viewerRating;
    return $self;
  }
}
<?php

declare(strict_types=1);

namespace Believe\Quotes;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Update specific fields of an existing quote.
  * @see Believe\Services\QuotesService::update()
  *
  * @phpstan-type QuoteUpdateParamsShape = array{
  *   characterID?: string|null,
  *   context?: string|null,
  *   episodeID?: string|null,
  *   isFunny?: bool|null,
  *   isInspirational?: bool|null,
  *   momentType?: null|QuoteMoment|value-of<QuoteMoment>,
  *   popularityScore?: float|null,
  *   secondaryThemes?: list<QuoteTheme|value-of<QuoteTheme>>|null,
  *   text?: string|null,
  *   theme?: null|QuoteTheme|value-of<QuoteTheme>,
  *   timesShared?: int|null,
  * }
  *
 */
final class QuoteUpdateParams implements BaseModel
{
  /** @use SdkModel<QuoteUpdateParamsShape> */
  use SdkModel;
  use SdkParams;

  /** @var string|null $characterID */
  #[Optional('character_id', nullable: true)]
  public ?string $characterID;

  /** @var string|null $context */
  #[Optional(nullable: true)]
  public ?string $context;

  /** @var string|null $episodeID */
  #[Optional('episode_id', nullable: true)]
  public ?string $episodeID;

  /** @var bool|null $isFunny */
  #[Optional('is_funny', nullable: true)]
  public ?bool $isFunny;

  /** @var bool|null $isInspirational */
  #[Optional('is_inspirational', nullable: true)]
  public ?bool $isInspirational;

  /**
  * Types of moments when quotes occur.
  *
  * @var value-of<QuoteMoment>|null $momentType
 */
  #[Optional('moment_type', enum: QuoteMoment::class, nullable: true)]
  public ?string $momentType;

  /** @var float|null $popularityScore */
  #[Optional('popularity_score', nullable: true)]
  public ?float $popularityScore;

  /** @var list<value-of<QuoteTheme>>|null $secondaryThemes */
  #[Optional('secondary_themes', list: QuoteTheme::class, nullable: true)]
  public ?array $secondaryThemes;

  /** @var string|null $text */
  #[Optional(nullable: true)]
  public ?string $text;

  /**
  * Themes that quotes can be categorized under.
  *
  * @var value-of<QuoteTheme>|null $theme
 */
  #[Optional(enum: QuoteTheme::class, nullable: true)]
  public ?string $theme;

  /** @var int|null $timesShared */
  #[Optional('times_shared', nullable: true)]
  public ?int $timesShared;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string|null $characterID
  * @param string|null $context
  * @param string|null $episodeID
  * @param bool|null $isFunny
  * @param bool|null $isInspirational
  * @param null|QuoteMoment|value-of<QuoteMoment> $momentType
  * @param float|null $popularityScore
  * @param list<QuoteTheme|value-of<QuoteTheme>>|null $secondaryThemes
  * @param string|null $text
  * @param null|QuoteTheme|value-of<QuoteTheme> $theme
  * @param int|null $timesShared
  *
  * @return self
 */
  public static function with(
    ?string $characterID = null,
    ?string $context = null,
    ?string $episodeID = null,
    ?bool $isFunny = null,
    ?bool $isInspirational = null,
    null|QuoteMoment|string $momentType = null,
    ?float $popularityScore = null,
    ?array $secondaryThemes = null,
    ?string $text = null,
    null|QuoteTheme|string $theme = null,
    ?int $timesShared = null,
  ): self {
    $self = new self;

    null !== $characterID && $self['characterID'] = $characterID;
    null !== $context && $self['context'] = $context;
    null !== $episodeID && $self['episodeID'] = $episodeID;
    null !== $isFunny && $self['isFunny'] = $isFunny;
    null !== $isInspirational && $self['isInspirational'] = $isInspirational;
    null !== $momentType && $self['momentType'] = $momentType;
    null !== $popularityScore && $self['popularityScore'] = $popularityScore;
    null !== $secondaryThemes && $self['secondaryThemes'] = $secondaryThemes;
    null !== $text && $self['text'] = $text;
    null !== $theme && $self['theme'] = $theme;
    null !== $timesShared && $self['timesShared'] = $timesShared;

    return $self;
  }

  /**
  * @param string|null $characterID
  *
  * @return self
 */
  public function withCharacterID(?string $characterID): self {
    $self = clone $this;
    $self['characterID'] = $characterID;
    return $self;
  }

  /**
  * @param string|null $context
  *
  * @return self
 */
  public function withContext(?string $context): self {
    $self = clone $this;
    $self['context'] = $context;
    return $self;
  }

  /**
  * @param string|null $episodeID
  *
  * @return self
 */
  public function withEpisodeID(?string $episodeID): self {
    $self = clone $this;
    $self['episodeID'] = $episodeID;
    return $self;
  }

  /**
  * @param bool|null $isFunny
  *
  * @return self
 */
  public function withIsFunny(?bool $isFunny): self {
    $self = clone $this;
    $self['isFunny'] = $isFunny;
    return $self;
  }

  /**
  * @param bool|null $isInspirational
  *
  * @return self
 */
  public function withIsInspirational(?bool $isInspirational): self {
    $self = clone $this;
    $self['isInspirational'] = $isInspirational;
    return $self;
  }

  /**
  * Types of moments when quotes occur.
  *
  * @param null|QuoteMoment|value-of<QuoteMoment> $momentType
  *
  * @return self
 */
  public function withMomentType(null|QuoteMoment|string $momentType): self {
    $self = clone $this;
    $self['momentType'] = $momentType;
    return $self;
  }

  /**
  * @param float|null $popularityScore
  *
  * @return self
 */
  public function withPopularityScore(?float $popularityScore): self {
    $self = clone $this;
    $self['popularityScore'] = $popularityScore;
    return $self;
  }

  /**
  * @param list<QuoteTheme|value-of<QuoteTheme>>|null $secondaryThemes
  *
  * @return self
 */
  public function withSecondaryThemes(?array $secondaryThemes): self {
    $self = clone $this;
    $self['secondaryThemes'] = $secondaryThemes;
    return $self;
  }

  /**
  * @param string|null $text
  *
  * @return self
 */
  public function withText(?string $text): self {
    $self = clone $this;
    $self['text'] = $text;
    return $self;
  }

  /**
  * Themes that quotes can be categorized under.
  *
  * @param null|QuoteTheme|value-of<QuoteTheme> $theme
  *
  * @return self
 */
  public function withTheme(null|QuoteTheme|string $theme): self {
    $self = clone $this;
    $self['theme'] = $theme;
    return $self;
  }

  /**
  * @param int|null $timesShared
  *
  * @return self
 */
  public function withTimesShared(?int $timesShared): self {
    $self = clone $this;
    $self['timesShared'] = $timesShared;
    return $self;
  }
}
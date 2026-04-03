<?php

declare(strict_types=1);

namespace Believe\Quotes;

use Believe\Core\Attributes\Required;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Full quote model with ID.
  *
  * @phpstan-type QuoteShape = array{
  *   id: string,
  *   characterID: string,
  *   context: string,
  *   momentType: QuoteMoment|value-of<QuoteMoment>,
  *   text: string,
  *   theme: QuoteTheme|value-of<QuoteTheme>,
  *   episodeID?: string|null,
  *   isFunny?: bool|null,
  *   isInspirational?: bool|null,
  *   popularityScore?: float|null,
  *   secondaryThemes?: list<QuoteTheme|value-of<QuoteTheme>>|null,
  *   timesShared?: int|null,
  * }
  *
 */
final class Quote implements BaseModel
{
  /** @use SdkModel<QuoteShape> */
  use SdkModel;

  /**
  * Unique identifier
  *
  * @var string $id
 */
  #[Required]
  public string $id;

  /**
  * ID of the character who said it
  *
  * @var string $characterID
 */
  #[Required('character_id')]
  public string $characterID;

  /**
  * Context in which the quote was said
  *
  * @var string $context
 */
  #[Required]
  public string $context;

  /**
  * Type of moment when the quote was said
  *
  * @var value-of<QuoteMoment> $momentType
 */
  #[Required('moment_type', enum: QuoteMoment::class)]
  public string $momentType;

  /**
  * The quote text
  *
  * @var string $text
 */
  #[Required]
  public string $text;

  /**
  * Primary theme of the quote
  *
  * @var value-of<QuoteTheme> $theme
 */
  #[Required(enum: QuoteTheme::class)]
  public string $theme;

  /**
  * Episode where the quote appears
  *
  * @var string|null $episodeID
 */
  #[Optional('episode_id', nullable: true)]
  public ?string $episodeID;

  /**
  * Whether this quote is humorous
  *
  * @var bool|null $isFunny
 */
  #[Optional('is_funny')]
  public ?bool $isFunny;

  /**
  * Whether this quote is inspirational
  *
  * @var bool|null $isInspirational
 */
  #[Optional('is_inspirational')]
  public ?bool $isInspirational;

  /**
  * Popularity/virality score (0-100)
  *
  * @var float|null $popularityScore
 */
  #[Optional('popularity_score', nullable: true)]
  public ?float $popularityScore;

  /**
  * Additional themes
  *
  * @var list<value-of<QuoteTheme>>|null $secondaryThemes
 */
  #[Optional('secondary_themes', list: QuoteTheme::class)]
  public ?array $secondaryThemes;

  /**
  * Number of times shared on social media
  *
  * @var int|null $timesShared
 */
  #[Optional('times_shared', nullable: true)]
  public ?int $timesShared;

  /**
  * `new Quote()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * Quote::with(
  *   id: ...,
  *   characterID: ...,
  *   context: ...,
  *   momentType: ...,
  *   text: ...,
  *   theme: ...,
  * )
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new Quote)
  *   ->withID(...)
  *   ->withCharacterID(...)
  *   ->withContext(...)
  *   ->withMomentType(...)
  *   ->withText(...)
  *   ->withTheme(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $id
  * @param string $characterID
  * @param string $context
  * @param QuoteMoment|value-of<QuoteMoment> $momentType
  * @param string $text
  * @param QuoteTheme|value-of<QuoteTheme> $theme
  * @param string|null $episodeID
  * @param bool|null $isFunny
  * @param bool|null $isInspirational
  * @param float|null $popularityScore
  * @param list<QuoteTheme|value-of<QuoteTheme>>|null $secondaryThemes
  * @param int|null $timesShared
  *
  * @return self
 */
  public static function with(
    string $id,
    string $characterID,
    string $context,
    QuoteMoment|string $momentType,
    string $text,
    QuoteTheme|string $theme,
    ?string $episodeID = null,
    bool $isFunny = null,
    bool $isInspirational = null,
    ?float $popularityScore = null,
    array $secondaryThemes = null,
    ?int $timesShared = null,
  ): self {
    $self = new self;

    $self['id'] = $id;
    $self['characterID'] = $characterID;
    $self['context'] = $context;
    $self['momentType'] = $momentType;
    $self['text'] = $text;
    $self['theme'] = $theme;

    null !== $episodeID && $self['episodeID'] = $episodeID;
    null !== $isFunny && $self['isFunny'] = $isFunny;
    null !== $isInspirational && $self['isInspirational'] = $isInspirational;
    null !== $popularityScore && $self['popularityScore'] = $popularityScore;
    null !== $secondaryThemes && $self['secondaryThemes'] = $secondaryThemes;
    null !== $timesShared && $self['timesShared'] = $timesShared;

    return $self;
  }

  /**
  * Unique identifier
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
  * ID of the character who said it
  *
  * @param string $characterID
  *
  * @return self
 */
  public function withCharacterID(string $characterID): self {
    $self = clone $this;
    $self['characterID'] = $characterID;
    return $self;
  }

  /**
  * Context in which the quote was said
  *
  * @param string $context
  *
  * @return self
 */
  public function withContext(string $context): self {
    $self = clone $this;
    $self['context'] = $context;
    return $self;
  }

  /**
  * Type of moment when the quote was said
  *
  * @param QuoteMoment|value-of<QuoteMoment> $momentType
  *
  * @return self
 */
  public function withMomentType(QuoteMoment|string $momentType): self {
    $self = clone $this;
    $self['momentType'] = $momentType;
    return $self;
  }

  /**
  * The quote text
  *
  * @param string $text
  *
  * @return self
 */
  public function withText(string $text): self {
    $self = clone $this;
    $self['text'] = $text;
    return $self;
  }

  /**
  * Primary theme of the quote
  *
  * @param QuoteTheme|value-of<QuoteTheme> $theme
  *
  * @return self
 */
  public function withTheme(QuoteTheme|string $theme): self {
    $self = clone $this;
    $self['theme'] = $theme;
    return $self;
  }

  /**
  * Episode where the quote appears
  *
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
  * Whether this quote is humorous
  *
  * @param bool $isFunny
  *
  * @return self
 */
  public function withIsFunny(bool $isFunny): self {
    $self = clone $this;
    $self['isFunny'] = $isFunny;
    return $self;
  }

  /**
  * Whether this quote is inspirational
  *
  * @param bool $isInspirational
  *
  * @return self
 */
  public function withIsInspirational(bool $isInspirational): self {
    $self = clone $this;
    $self['isInspirational'] = $isInspirational;
    return $self;
  }

  /**
  * Popularity/virality score (0-100)
  *
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
  * Additional themes
  *
  * @param list<QuoteTheme|value-of<QuoteTheme>> $secondaryThemes
  *
  * @return self
 */
  public function withSecondaryThemes(array $secondaryThemes): self {
    $self = clone $this;
    $self['secondaryThemes'] = $secondaryThemes;
    return $self;
  }

  /**
  * Number of times shared on social media
  *
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
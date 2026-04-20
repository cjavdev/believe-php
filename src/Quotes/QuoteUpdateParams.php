<?php

declare(strict_types=1);

namespace Believe\Quotes;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Update specific fields of an existing quote.
 *
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
 */
final class QuoteUpdateParams implements BaseModel
{
    /** @use SdkModel<QuoteUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional('character_id', nullable: true)]
    public ?string $characterID;

    #[Optional(nullable: true)]
    public ?string $context;

    #[Optional('episode_id', nullable: true)]
    public ?string $episodeID;

    #[Optional('is_funny', nullable: true)]
    public ?bool $isFunny;

    #[Optional('is_inspirational', nullable: true)]
    public ?bool $isInspirational;

    /**
     * Types of moments when quotes occur.
     *
     * @var value-of<QuoteMoment>|null $momentType
     */
    #[Optional('moment_type', enum: QuoteMoment::class, nullable: true)]
    public ?string $momentType;

    #[Optional('popularity_score', nullable: true)]
    public ?float $popularityScore;

    /** @var list<value-of<QuoteTheme>>|null $secondaryThemes */
    #[Optional('secondary_themes', list: QuoteTheme::class, nullable: true)]
    public ?array $secondaryThemes;

    #[Optional(nullable: true)]
    public ?string $text;

    /**
     * Themes that quotes can be categorized under.
     *
     * @var value-of<QuoteTheme>|null $theme
     */
    #[Optional(enum: QuoteTheme::class, nullable: true)]
    public ?string $theme;

    #[Optional('times_shared', nullable: true)]
    public ?int $timesShared;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param QuoteMoment|value-of<QuoteMoment>|null $momentType
     * @param list<QuoteTheme|value-of<QuoteTheme>>|null $secondaryThemes
     * @param QuoteTheme|value-of<QuoteTheme>|null $theme
     */
    public static function with(
        ?string $characterID = null,
        ?string $context = null,
        ?string $episodeID = null,
        ?bool $isFunny = null,
        ?bool $isInspirational = null,
        QuoteMoment|string|null $momentType = null,
        ?float $popularityScore = null,
        ?array $secondaryThemes = null,
        ?string $text = null,
        QuoteTheme|string|null $theme = null,
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

    public function withCharacterID(?string $characterID): self
    {
        $self = clone $this;
        $self['characterID'] = $characterID;

        return $self;
    }

    public function withContext(?string $context): self
    {
        $self = clone $this;
        $self['context'] = $context;

        return $self;
    }

    public function withEpisodeID(?string $episodeID): self
    {
        $self = clone $this;
        $self['episodeID'] = $episodeID;

        return $self;
    }

    public function withIsFunny(?bool $isFunny): self
    {
        $self = clone $this;
        $self['isFunny'] = $isFunny;

        return $self;
    }

    public function withIsInspirational(?bool $isInspirational): self
    {
        $self = clone $this;
        $self['isInspirational'] = $isInspirational;

        return $self;
    }

    /**
     * Types of moments when quotes occur.
     *
     * @param QuoteMoment|value-of<QuoteMoment>|null $momentType
     */
    public function withMomentType(QuoteMoment|string|null $momentType): self
    {
        $self = clone $this;
        $self['momentType'] = $momentType;

        return $self;
    }

    public function withPopularityScore(?float $popularityScore): self
    {
        $self = clone $this;
        $self['popularityScore'] = $popularityScore;

        return $self;
    }

    /**
     * @param list<QuoteTheme|value-of<QuoteTheme>>|null $secondaryThemes
     */
    public function withSecondaryThemes(?array $secondaryThemes): self
    {
        $self = clone $this;
        $self['secondaryThemes'] = $secondaryThemes;

        return $self;
    }

    public function withText(?string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Themes that quotes can be categorized under.
     *
     * @param QuoteTheme|value-of<QuoteTheme>|null $theme
     */
    public function withTheme(QuoteTheme|string|null $theme): self
    {
        $self = clone $this;
        $self['theme'] = $theme;

        return $self;
    }

    public function withTimesShared(?int $timesShared): self
    {
        $self = clone $this;
        $self['timesShared'] = $timesShared;

        return $self;
    }
}

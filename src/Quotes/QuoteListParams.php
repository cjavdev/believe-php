<?php

declare(strict_types=1);

namespace Believe\Quotes;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Get a paginated list of all memorable Ted Lasso quotes with optional filtering.
 *
 * @see Believe\Services\QuotesService::list()
 *
 * @phpstan-type QuoteListParamsShape = array{
 *   characterID?: string|null,
 *   funny?: bool|null,
 *   inspirational?: bool|null,
 *   limit?: int|null,
 *   momentType?: null|QuoteMoment|value-of<QuoteMoment>,
 *   skip?: int|null,
 *   theme?: null|QuoteTheme|value-of<QuoteTheme>,
 * }
 */
final class QuoteListParams implements BaseModel
{
    /** @use SdkModel<QuoteListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by character.
     */
    #[Optional(nullable: true)]
    public ?string $characterID;

    /**
     * Filter funny quotes.
     */
    #[Optional(nullable: true)]
    public ?bool $funny;

    /**
     * Filter inspirational quotes.
     */
    #[Optional(nullable: true)]
    public ?bool $inspirational;

    /**
     * Maximum number of items to return (max: 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter by moment type.
     *
     * @var value-of<QuoteMoment>|null $momentType
     */
    #[Optional(enum: QuoteMoment::class, nullable: true)]
    public ?string $momentType;

    /**
     * Number of items to skip (offset).
     */
    #[Optional]
    public ?int $skip;

    /**
     * Filter by theme.
     *
     * @var value-of<QuoteTheme>|null $theme
     */
    #[Optional(enum: QuoteTheme::class, nullable: true)]
    public ?string $theme;

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
     * @param QuoteTheme|value-of<QuoteTheme>|null $theme
     */
    public static function with(
        ?string $characterID = null,
        ?bool $funny = null,
        ?bool $inspirational = null,
        ?int $limit = null,
        QuoteMoment|string|null $momentType = null,
        ?int $skip = null,
        QuoteTheme|string|null $theme = null,
    ): self {
        $self = new self;

        null !== $characterID && $self['characterID'] = $characterID;
        null !== $funny && $self['funny'] = $funny;
        null !== $inspirational && $self['inspirational'] = $inspirational;
        null !== $limit && $self['limit'] = $limit;
        null !== $momentType && $self['momentType'] = $momentType;
        null !== $skip && $self['skip'] = $skip;
        null !== $theme && $self['theme'] = $theme;

        return $self;
    }

    /**
     * Filter by character.
     */
    public function withCharacterID(?string $characterID): self
    {
        $self = clone $this;
        $self['characterID'] = $characterID;

        return $self;
    }

    /**
     * Filter funny quotes.
     */
    public function withFunny(?bool $funny): self
    {
        $self = clone $this;
        $self['funny'] = $funny;

        return $self;
    }

    /**
     * Filter inspirational quotes.
     */
    public function withInspirational(?bool $inspirational): self
    {
        $self = clone $this;
        $self['inspirational'] = $inspirational;

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
     * Filter by moment type.
     *
     * @param QuoteMoment|value-of<QuoteMoment>|null $momentType
     */
    public function withMomentType(QuoteMoment|string|null $momentType): self
    {
        $self = clone $this;
        $self['momentType'] = $momentType;

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
     * Filter by theme.
     *
     * @param QuoteTheme|value-of<QuoteTheme>|null $theme
     */
    public function withTheme(QuoteTheme|string|null $theme): self
    {
        $self = clone $this;
        $self['theme'] = $theme;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Believe\Quotes;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Get a paginated list of all memorable Ted Lasso quotes with optional filtering.
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
  *
 */
final class QuoteListParams implements BaseModel
{
  /** @use SdkModel<QuoteListParamsShape> */
  use SdkModel;
  use SdkParams;

  /**
  * Filter by character
  *
  * @var string|null $characterID
 */
  #[Optional(nullable: true)]
  public ?string $characterID;

  /**
  * Filter funny quotes
  *
  * @var bool|null $funny
 */
  #[Optional(nullable: true)]
  public ?bool $funny;

  /**
  * Filter inspirational quotes
  *
  * @var bool|null $inspirational
 */
  #[Optional(nullable: true)]
  public ?bool $inspirational;

  /**
  * Maximum number of items to return (max: 100)
  *
  * @var int|null $limit
 */
  #[Optional]
  public ?int $limit;

  /**
  * Filter by moment type
  *
  * @var value-of<QuoteMoment>|null $momentType
 */
  #[Optional(enum: QuoteMoment::class, nullable: true)]
  public ?string $momentType;

  /**
  * Number of items to skip (offset)
  *
  * @var int|null $skip
 */
  #[Optional]
  public ?int $skip;

  /**
  * Filter by theme
  *
  * @var value-of<QuoteTheme>|null $theme
 */
  #[Optional(enum: QuoteTheme::class, nullable: true)]
  public ?string $theme;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string|null $characterID
  * @param bool|null $funny
  * @param bool|null $inspirational
  * @param int|null $limit
  * @param null|QuoteMoment|value-of<QuoteMoment> $momentType
  * @param int|null $skip
  * @param null|QuoteTheme|value-of<QuoteTheme> $theme
  *
  * @return self
 */
  public static function with(
    ?string $characterID = null,
    ?bool $funny = null,
    ?bool $inspirational = null,
    int $limit = null,
    null|QuoteMoment|string $momentType = null,
    int $skip = null,
    null|QuoteTheme|string $theme = null,
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
  * Filter by character
  *
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
  * Filter funny quotes
  *
  * @param bool|null $funny
  *
  * @return self
 */
  public function withFunny(?bool $funny): self {
    $self = clone $this;
    $self['funny'] = $funny;
    return $self;
  }

  /**
  * Filter inspirational quotes
  *
  * @param bool|null $inspirational
  *
  * @return self
 */
  public function withInspirational(?bool $inspirational): self {
    $self = clone $this;
    $self['inspirational'] = $inspirational;
    return $self;
  }

  /**
  * Maximum number of items to return (max: 100)
  *
  * @param int $limit
  *
  * @return self
 */
  public function withLimit(int $limit): self {
    $self = clone $this;
    $self['limit'] = $limit;
    return $self;
  }

  /**
  * Filter by moment type
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
  * Number of items to skip (offset)
  *
  * @param int $skip
  *
  * @return self
 */
  public function withSkip(int $skip): self {
    $self = clone $this;
    $self['skip'] = $skip;
    return $self;
  }

  /**
  * Filter by theme
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
}
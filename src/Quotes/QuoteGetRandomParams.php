<?php

declare(strict_types=1);

namespace Believe\Quotes;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Get a random Ted Lasso quote, optionally filtered.
  * @see Believe\Services\QuotesService::getRandom()
  *
  * @phpstan-type QuoteGetRandomParamsShape = array{
  *   characterID?: string|null,
  *   inspirational?: bool|null,
  *   theme?: null|QuoteTheme|value-of<QuoteTheme>,
  * }
  *
 */
final class QuoteGetRandomParams implements BaseModel
{
  /** @use SdkModel<QuoteGetRandomParamsShape> */
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
  * Filter inspirational quotes
  *
  * @var bool|null $inspirational
 */
  #[Optional(nullable: true)]
  public ?bool $inspirational;

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
  * @param bool|null $inspirational
  * @param null|QuoteTheme|value-of<QuoteTheme> $theme
  *
  * @return self
 */
  public static function with(
    ?string $characterID = null,
    ?bool $inspirational = null,
    null|QuoteTheme|string $theme = null,
  ): self {
    $self = new self;

    null !== $characterID && $self['characterID'] = $characterID;
    null !== $inspirational && $self['inspirational'] = $inspirational;
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
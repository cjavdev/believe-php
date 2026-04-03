<?php

declare(strict_types=1);

namespace Believe\Quotes;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Get a paginated list of quotes from a specific character.
  * @see Believe\Services\QuotesService::listByCharacter()
  *
  * @phpstan-type QuoteListByCharacterParamsShape = array{
  *   limit?: int|null, skip?: int|null
  * }
  *
 */
final class QuoteListByCharacterParams implements BaseModel
{
  /** @use SdkModel<QuoteListByCharacterParamsShape> */
  use SdkModel;
  use SdkParams;

  /**
  * Maximum number of items to return (max: 100)
  *
  * @var int|null $limit
 */
  #[Optional]
  public ?int $limit;

  /**
  * Number of items to skip (offset)
  *
  * @var int|null $skip
 */
  #[Optional]
  public ?int $skip;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param int|null $limit
  * @param int|null $skip
  *
  * @return self
 */
  public static function with(int $limit = null, int $skip = null): self {
    $self = new self;

    null !== $limit && $self['limit'] = $limit;
    null !== $skip && $self['skip'] = $skip;

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
}
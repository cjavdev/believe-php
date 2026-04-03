<?php

declare(strict_types=1);

namespace Believe\Reframe;

use Believe\Core\Attributes\Required;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Transform negative thoughts into positive perspectives with Ted's help.
  * @see Believe\Services\ReframeService::transformNegativeThoughts()
  *
  * @phpstan-type ReframeTransformNegativeThoughtsParamsShape = array{
  *   negativeThought: string, recurring?: bool|null
  * }
  *
 */
final class ReframeTransformNegativeThoughtsParams implements BaseModel
{
  /** @use SdkModel<ReframeTransformNegativeThoughtsParamsShape> */
  use SdkModel;
  use SdkParams;

  /**
  * The negative thought to reframe
  *
  * @var string $negativeThought
 */
  #[Required('negative_thought')]
  public string $negativeThought;

  /**
  * Is this a recurring thought?
  *
  * @var bool|null $recurring
 */
  #[Optional]
  public ?bool $recurring;

  /**
  * `new ReframeTransformNegativeThoughtsParams()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * ReframeTransformNegativeThoughtsParams::with(negativeThought: ...)
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new ReframeTransformNegativeThoughtsParams)->withNegativeThought(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $negativeThought
  * @param bool|null $recurring
  *
  * @return self
 */
  public static function with(
    string $negativeThought, bool $recurring = null
  ): self {
    $self = new self;

    $self['negativeThought'] = $negativeThought;

    null !== $recurring && $self['recurring'] = $recurring;

    return $self;
  }

  /**
  * The negative thought to reframe
  *
  * @param string $negativeThought
  *
  * @return self
 */
  public function withNegativeThought(string $negativeThought): self {
    $self = clone $this;
    $self['negativeThought'] = $negativeThought;
    return $self;
  }

  /**
  * Is this a recurring thought?
  *
  * @param bool $recurring
  *
  * @return self
 */
  public function withRecurring(bool $recurring): self {
    $self = clone $this;
    $self['recurring'] = $recurring;
    return $self;
  }
}
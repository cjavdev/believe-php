<?php

declare(strict_types=1);

namespace Believe\Believe;

use Believe\Believe\BelieveSubmitParams\SituationType;
use Believe\Core\Attributes\Required;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Submit your situation and receive Ted Lasso-style motivational guidance.
  * @see Believe\Services\BelieveService::submit()
  *
  * @phpstan-type BelieveSubmitParamsShape = array{
  *   situation: string,
  *   situationType: SituationType|value-of<SituationType>,
  *   context?: string|null,
  *   intensity?: int|null,
  * }
  *
 */
final class BelieveSubmitParams implements BaseModel
{
  /** @use SdkModel<BelieveSubmitParamsShape> */
  use SdkModel;
  use SdkParams;

  /**
  * Describe your situation
  *
  * @var string $situation
 */
  #[Required]
  public string $situation;

  /**
  * Type of situation
  *
  * @var value-of<SituationType> $situationType
 */
  #[Required('situation_type', enum: SituationType::class)]
  public string $situationType;

  /**
  * Additional context
  *
  * @var string|null $context
 */
  #[Optional(nullable: true)]
  public ?string $context;

  /**
  * How intense is the response needed (1=gentle, 10=full Ted)
  *
  * @var int|null $intensity
 */
  #[Optional]
  public ?int $intensity;

  /**
  * `new BelieveSubmitParams()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * BelieveSubmitParams::with(situation: ..., situationType: ...)
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new BelieveSubmitParams)->withSituation(...)->withSituationType(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $situation
  * @param SituationType|value-of<SituationType> $situationType
  * @param string|null $context
  * @param int|null $intensity
  *
  * @return self
 */
  public static function with(
    string $situation,
    SituationType|string $situationType,
    ?string $context = null,
    int $intensity = null,
  ): self {
    $self = new self;

    $self['situation'] = $situation;
    $self['situationType'] = $situationType;

    null !== $context && $self['context'] = $context;
    null !== $intensity && $self['intensity'] = $intensity;

    return $self;
  }

  /**
  * Describe your situation
  *
  * @param string $situation
  *
  * @return self
 */
  public function withSituation(string $situation): self {
    $self = clone $this;
    $self['situation'] = $situation;
    return $self;
  }

  /**
  * Type of situation
  *
  * @param SituationType|value-of<SituationType> $situationType
  *
  * @return self
 */
  public function withSituationType(SituationType|string $situationType): self {
    $self = clone $this;
    $self['situationType'] = $situationType;
    return $self;
  }

  /**
  * Additional context
  *
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
  * How intense is the response needed (1=gentle, 10=full Ted)
  *
  * @param int $intensity
  *
  * @return self
 */
  public function withIntensity(int $intensity): self {
    $self = clone $this;
    $self['intensity'] = $intensity;
    return $self;
  }
}
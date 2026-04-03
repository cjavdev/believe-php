<?php

declare(strict_types=1);

namespace Believe\Matches;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * A pivotal moment in a match.
  *
  * @phpstan-type TurningPointShape = array{
  *   description: string,
  *   emotionalImpact: string,
  *   minute: int,
  *   characterInvolved?: string|null,
  * }
  *
 */
final class TurningPoint implements BaseModel
{
  /** @use SdkModel<TurningPointShape> */
  use SdkModel;

  /**
  * What happened
  *
  * @var string $description
 */
  #[Required]
  public string $description;

  /**
  * How this affected the team emotionally
  *
  * @var string $emotionalImpact
 */
  #[Required('emotional_impact')]
  public string $emotionalImpact;

  /**
  * Minute of the match
  *
  * @var int $minute
 */
  #[Required]
  public int $minute;

  /**
  * Character ID who was central to this moment
  *
  * @var string|null $characterInvolved
 */
  #[Optional('character_involved', nullable: true)]
  public ?string $characterInvolved;

  /**
  * `new TurningPoint()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * TurningPoint::with(description: ..., emotionalImpact: ..., minute: ...)
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new TurningPoint)
  *   ->withDescription(...)
  *   ->withEmotionalImpact(...)
  *   ->withMinute(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $description
  * @param string $emotionalImpact
  * @param int $minute
  * @param string|null $characterInvolved
  *
  * @return self
 */
  public static function with(
    string $description,
    string $emotionalImpact,
    int $minute,
    ?string $characterInvolved = null,
  ): self {
    $self = new self;

    $self['description'] = $description;
    $self['emotionalImpact'] = $emotionalImpact;
    $self['minute'] = $minute;

    null !== $characterInvolved && $self['characterInvolved'] = $characterInvolved;

    return $self;
  }

  /**
  * What happened
  *
  * @param string $description
  *
  * @return self
 */
  public function withDescription(string $description): self {
    $self = clone $this;
    $self['description'] = $description;
    return $self;
  }

  /**
  * How this affected the team emotionally
  *
  * @param string $emotionalImpact
  *
  * @return self
 */
  public function withEmotionalImpact(string $emotionalImpact): self {
    $self = clone $this;
    $self['emotionalImpact'] = $emotionalImpact;
    return $self;
  }

  /**
  * Minute of the match
  *
  * @param int $minute
  *
  * @return self
 */
  public function withMinute(int $minute): self {
    $self = clone $this;
    $self['minute'] = $minute;
    return $self;
  }

  /**
  * Character ID who was central to this moment
  *
  * @param string|null $characterInvolved
  *
  * @return self
 */
  public function withCharacterInvolved(?string $characterInvolved): self {
    $self = clone $this;
    $self['characterInvolved'] = $characterInvolved;
    return $self;
  }
}
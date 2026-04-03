<?php

declare(strict_types=1);

namespace Believe\Reframe;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Reframed perspective response.
  *
  * @phpstan-type ReframeTransformNegativeThoughtsResponseShape = array{
  *   dailyAffirmation: string,
  *   originalThought: string,
  *   reframedThought: string,
  *   tedPerspective: string,
  *   drSharonInsight?: string|null,
  * }
  *
 */
final class ReframeTransformNegativeThoughtsResponse implements BaseModel
{
  /** @use SdkModel<ReframeTransformNegativeThoughtsResponseShape> */
  use SdkModel;

  /**
  * A daily affirmation to practice
  *
  * @var string $dailyAffirmation
 */
  #[Required('daily_affirmation')]
  public string $dailyAffirmation;

  /**
  * The original negative thought
  *
  * @var string $originalThought
 */
  #[Required('original_thought')]
  public string $originalThought;

  /**
  * The thought reframed positively
  *
  * @var string $reframedThought
 */
  #[Required('reframed_thought')]
  public string $reframedThought;

  /**
  * Ted's take on this thought
  *
  * @var string $tedPerspective
 */
  #[Required('ted_perspective')]
  public string $tedPerspective;

  /**
  * Dr. Sharon's therapeutic insight
  *
  * @var string|null $drSharonInsight
 */
  #[Optional('dr_sharon_insight', nullable: true)]
  public ?string $drSharonInsight;

  /**
  * `new ReframeTransformNegativeThoughtsResponse()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * ReframeTransformNegativeThoughtsResponse::with(
  *   dailyAffirmation: ...,
  *   originalThought: ...,
  *   reframedThought: ...,
  *   tedPerspective: ...,
  * )
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new ReframeTransformNegativeThoughtsResponse)
  *   ->withDailyAffirmation(...)
  *   ->withOriginalThought(...)
  *   ->withReframedThought(...)
  *   ->withTedPerspective(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $dailyAffirmation
  * @param string $originalThought
  * @param string $reframedThought
  * @param string $tedPerspective
  * @param string|null $drSharonInsight
  *
  * @return self
 */
  public static function with(
    string $dailyAffirmation,
    string $originalThought,
    string $reframedThought,
    string $tedPerspective,
    ?string $drSharonInsight = null,
  ): self {
    $self = new self;

    $self['dailyAffirmation'] = $dailyAffirmation;
    $self['originalThought'] = $originalThought;
    $self['reframedThought'] = $reframedThought;
    $self['tedPerspective'] = $tedPerspective;

    null !== $drSharonInsight && $self['drSharonInsight'] = $drSharonInsight;

    return $self;
  }

  /**
  * A daily affirmation to practice
  *
  * @param string $dailyAffirmation
  *
  * @return self
 */
  public function withDailyAffirmation(string $dailyAffirmation): self {
    $self = clone $this;
    $self['dailyAffirmation'] = $dailyAffirmation;
    return $self;
  }

  /**
  * The original negative thought
  *
  * @param string $originalThought
  *
  * @return self
 */
  public function withOriginalThought(string $originalThought): self {
    $self = clone $this;
    $self['originalThought'] = $originalThought;
    return $self;
  }

  /**
  * The thought reframed positively
  *
  * @param string $reframedThought
  *
  * @return self
 */
  public function withReframedThought(string $reframedThought): self {
    $self = clone $this;
    $self['reframedThought'] = $reframedThought;
    return $self;
  }

  /**
  * Ted's take on this thought
  *
  * @param string $tedPerspective
  *
  * @return self
 */
  public function withTedPerspective(string $tedPerspective): self {
    $self = clone $this;
    $self['tedPerspective'] = $tedPerspective;
    return $self;
  }

  /**
  * Dr. Sharon's therapeutic insight
  *
  * @param string|null $drSharonInsight
  *
  * @return self
 */
  public function withDrSharonInsight(?string $drSharonInsight): self {
    $self = clone $this;
    $self['drSharonInsight'] = $drSharonInsight;
    return $self;
  }
}
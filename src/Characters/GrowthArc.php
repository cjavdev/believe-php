<?php

declare(strict_types=1);

namespace Believe\Characters;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Character development arc.
  *
  * @phpstan-type GrowthArcShape = array{
  *   breakthrough: string,
  *   challenge: string,
  *   endingPoint: string,
  *   season: int,
  *   startingPoint: string,
  * }
  *
 */
final class GrowthArc implements BaseModel
{
  /** @use SdkModel<GrowthArcShape> */
  use SdkModel;

  /**
  * Key breakthrough moment
  *
  * @var string $breakthrough
 */
  #[Required]
  public string $breakthrough;

  /**
  * Main challenge faced
  *
  * @var string $challenge
 */
  #[Required]
  public string $challenge;

  /**
  * Where the character ends up
  *
  * @var string $endingPoint
 */
  #[Required('ending_point')]
  public string $endingPoint;

  /**
  * Season number
  *
  * @var int $season
 */
  #[Required]
  public int $season;

  /**
  * Where the character starts emotionally
  *
  * @var string $startingPoint
 */
  #[Required('starting_point')]
  public string $startingPoint;

  /**
  * `new GrowthArc()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * GrowthArc::with(
  *   breakthrough: ...,
  *   challenge: ...,
  *   endingPoint: ...,
  *   season: ...,
  *   startingPoint: ...,
  * )
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new GrowthArc)
  *   ->withBreakthrough(...)
  *   ->withChallenge(...)
  *   ->withEndingPoint(...)
  *   ->withSeason(...)
  *   ->withStartingPoint(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $breakthrough
  * @param string $challenge
  * @param string $endingPoint
  * @param int $season
  * @param string $startingPoint
  *
  * @return self
 */
  public static function with(
    string $breakthrough,
    string $challenge,
    string $endingPoint,
    int $season,
    string $startingPoint,
  ): self {
    $self = new self;

    $self['breakthrough'] = $breakthrough;
    $self['challenge'] = $challenge;
    $self['endingPoint'] = $endingPoint;
    $self['season'] = $season;
    $self['startingPoint'] = $startingPoint;

    return $self;
  }

  /**
  * Key breakthrough moment
  *
  * @param string $breakthrough
  *
  * @return self
 */
  public function withBreakthrough(string $breakthrough): self {
    $self = clone $this;
    $self['breakthrough'] = $breakthrough;
    return $self;
  }

  /**
  * Main challenge faced
  *
  * @param string $challenge
  *
  * @return self
 */
  public function withChallenge(string $challenge): self {
    $self = clone $this;
    $self['challenge'] = $challenge;
    return $self;
  }

  /**
  * Where the character ends up
  *
  * @param string $endingPoint
  *
  * @return self
 */
  public function withEndingPoint(string $endingPoint): self {
    $self = clone $this;
    $self['endingPoint'] = $endingPoint;
    return $self;
  }

  /**
  * Season number
  *
  * @param int $season
  *
  * @return self
 */
  public function withSeason(int $season): self {
    $self = clone $this;
    $self['season'] = $season;
    return $self;
  }

  /**
  * Where the character starts emotionally
  *
  * @param string $startingPoint
  *
  * @return self
 */
  public function withStartingPoint(string $startingPoint): self {
    $self = clone $this;
    $self['startingPoint'] = $startingPoint;
    return $self;
  }
}
<?php

declare(strict_types=1);

namespace Believe\Matches;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * WebSocket endpoint for real-time live match simulation.
  *
  * Connect to receive a stream of match events as they happen in a simulated football match.
  *
  * ## Connection
  *
  * Connect via WebSocket with optional query parameters to customize the simulation.
  *
  * ## Example WebSocket URL
  *
  * ```
  * ws://localhost:8000/matches/live?home_team=AFC%20Richmond&away_team=Manchester%20City&speed=2.0&excitement_level=7
  * ```
  *
  * ## Server Messages
  *
  * The server sends JSON messages with these types:
  * - `match_start` - When the match begins
  * - `match_event` - For each match event (goals, fouls, cards, etc.)
  * - `match_end` - When the match concludes
  * - `error` - If an error occurs
  * - `pong` - Response to client ping
  *
  * ## Client Messages
  *
  * Send JSON to control the simulation:
  * - `{"action": "ping"}` - Keep-alive, server responds with `{"type": "pong"}`
  * - `{"action": "pause"}` - Pause the simulation
  * - `{"action": "resume"}` - Resume a paused simulation
  * - `{"action": "set_speed", "speed": 2.0}` - Change playback speed (0.1-10.0)
  * - `{"action": "get_status"}` - Request current match status
  *
  * @see Believe\Services\MatchesService::streamLive()
  *
  * @phpstan-type MatchStreamLiveParamsShape = array{
  *   awayTeam?: string|null,
  *   excitementLevel?: int|null,
  *   homeTeam?: string|null,
  *   speed?: float|null,
  * }
  *
 */
final class MatchStreamLiveParams implements BaseModel
{
  /** @use SdkModel<MatchStreamLiveParamsShape> */
  use SdkModel;
  use SdkParams;

  /**
  * Away team name
  *
  * @var string|null $awayTeam
 */
  #[Optional]
  public ?string $awayTeam;

  /**
  * How eventful the match should be (1=boring, 10=chaos)
  *
  * @var int|null $excitementLevel
 */
  #[Optional]
  public ?int $excitementLevel;

  /**
  * Home team name
  *
  * @var string|null $homeTeam
 */
  #[Optional]
  public ?string $homeTeam;

  /**
  * Simulation speed multiplier (1.0 = real-time)
  *
  * @var float|null $speed
 */
  #[Optional]
  public ?float $speed;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string|null $awayTeam
  * @param int|null $excitementLevel
  * @param string|null $homeTeam
  * @param float|null $speed
  *
  * @return self
 */
  public static function with(
    string $awayTeam = null,
    int $excitementLevel = null,
    string $homeTeam = null,
    float $speed = null,
  ): self {
    $self = new self;

    null !== $awayTeam && $self['awayTeam'] = $awayTeam;
    null !== $excitementLevel && $self['excitementLevel'] = $excitementLevel;
    null !== $homeTeam && $self['homeTeam'] = $homeTeam;
    null !== $speed && $self['speed'] = $speed;

    return $self;
  }

  /**
  * Away team name
  *
  * @param string $awayTeam
  *
  * @return self
 */
  public function withAwayTeam(string $awayTeam): self {
    $self = clone $this;
    $self['awayTeam'] = $awayTeam;
    return $self;
  }

  /**
  * How eventful the match should be (1=boring, 10=chaos)
  *
  * @param int $excitementLevel
  *
  * @return self
 */
  public function withExcitementLevel(int $excitementLevel): self {
    $self = clone $this;
    $self['excitementLevel'] = $excitementLevel;
    return $self;
  }

  /**
  * Home team name
  *
  * @param string $homeTeam
  *
  * @return self
 */
  public function withHomeTeam(string $homeTeam): self {
    $self = clone $this;
    $self['homeTeam'] = $homeTeam;
    return $self;
  }

  /**
  * Simulation speed multiplier (1.0 = real-time)
  *
  * @param float $speed
  *
  * @return self
 */
  public function withSpeed(float $speed): self {
    $self = clone $this;
    $self['speed'] = $speed;
    return $self;
  }
}
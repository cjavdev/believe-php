<?php

declare(strict_types=1);

namespace Believe\Matches;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Update specific fields of an existing match (e.g., update score).
  * @see Believe\Services\MatchesService::update()
  * @phpstan-import-type TicketRevenueGbpVariants from \Believe\Matches\MatchUpdateParams\TicketRevenueGbp
  * @phpstan-import-type TicketRevenueGbpShape from \Believe\Matches\MatchUpdateParams\TicketRevenueGbp
  * @phpstan-import-type TurningPointShape from \Believe\Matches\TurningPoint
  * @phpstan-type MatchUpdateParamsShape = array{
  *   attendance?: int|null,
  *   awayScore?: int|null,
  *   awayTeamID?: string|null,
  *   date?: \DateTimeInterface|null,
  *   episodeID?: string|null,
  *   homeScore?: int|null,
  *   homeTeamID?: string|null,
  *   lessonLearned?: string|null,
  *   matchType?: null|MatchType|value-of<MatchType>,
  *   possessionPercentage?: float|null,
  *   result?: null|MatchResult|value-of<MatchResult>,
  *   tedHalftimeSpeech?: string|null,
  *   ticketRevenueGbp?: TicketRevenueGbpShape|null,
  *   turningPoints?: list<TurningPoint|TurningPointShape>|null,
  *   weatherTempCelsius?: float|null,
  * }
  *
 */
final class MatchUpdateParams implements BaseModel
{
  /** @use SdkModel<MatchUpdateParamsShape> */
  use SdkModel;
  use SdkParams;

  /** @var int|null $attendance */
  #[Optional(nullable: true)]
  public ?int $attendance;

  /** @var int|null $awayScore */
  #[Optional('away_score', nullable: true)]
  public ?int $awayScore;

  /** @var string|null $awayTeamID */
  #[Optional('away_team_id', nullable: true)]
  public ?string $awayTeamID;

  /** @var \DateTimeInterface|null $date */
  #[Optional(nullable: true)]
  public ?\DateTimeInterface $date;

  /** @var string|null $episodeID */
  #[Optional('episode_id', nullable: true)]
  public ?string $episodeID;

  /** @var int|null $homeScore */
  #[Optional('home_score', nullable: true)]
  public ?int $homeScore;

  /** @var string|null $homeTeamID */
  #[Optional('home_team_id', nullable: true)]
  public ?string $homeTeamID;

  /** @var string|null $lessonLearned */
  #[Optional('lesson_learned', nullable: true)]
  public ?string $lessonLearned;

  /**
  * Types of matches.
  *
  * @var value-of<MatchType>|null $matchType
 */
  #[Optional('match_type', enum: MatchType::class, nullable: true)]
  public ?string $matchType;

  /** @var float|null $possessionPercentage */
  #[Optional('possession_percentage', nullable: true)]
  public ?float $possessionPercentage;

  /**
  * Match result types.
  *
  * @var value-of<MatchResult>|null $result
 */
  #[Optional(enum: MatchResult::class, nullable: true)]
  public ?string $result;

  /** @var string|null $tedHalftimeSpeech */
  #[Optional('ted_halftime_speech', nullable: true)]
  public ?string $tedHalftimeSpeech;

  /** @var TicketRevenueGbpVariants|null $ticketRevenueGbp */
  #[Optional('ticket_revenue_gbp', nullable: true)]
  public float|string|null $ticketRevenueGbp;

  /** @var list<TurningPoint>|null $turningPoints */
  #[Optional('turning_points', list: TurningPoint::class, nullable: true)]
  public ?array $turningPoints;

  /** @var float|null $weatherTempCelsius */
  #[Optional('weather_temp_celsius', nullable: true)]
  public ?float $weatherTempCelsius;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param int|null $attendance
  * @param int|null $awayScore
  * @param string|null $awayTeamID
  * @param \DateTimeInterface|null $date
  * @param string|null $episodeID
  * @param int|null $homeScore
  * @param string|null $homeTeamID
  * @param string|null $lessonLearned
  * @param null|MatchType|value-of<MatchType> $matchType
  * @param float|null $possessionPercentage
  * @param null|MatchResult|value-of<MatchResult> $result
  * @param string|null $tedHalftimeSpeech
  * @param TicketRevenueGbpShape|null $ticketRevenueGbp
  * @param list<TurningPoint|TurningPointShape>|null $turningPoints
  * @param float|null $weatherTempCelsius
  *
  * @return self
 */
  public static function with(
    ?int $attendance = null,
    ?int $awayScore = null,
    ?string $awayTeamID = null,
    ?\DateTimeInterface $date = null,
    ?string $episodeID = null,
    ?int $homeScore = null,
    ?string $homeTeamID = null,
    ?string $lessonLearned = null,
    null|MatchType|string $matchType = null,
    ?float $possessionPercentage = null,
    null|MatchResult|string $result = null,
    ?string $tedHalftimeSpeech = null,
    float|string|null $ticketRevenueGbp = null,
    ?array $turningPoints = null,
    ?float $weatherTempCelsius = null,
  ): self {
    $self = new self;

    null !== $attendance && $self['attendance'] = $attendance;
    null !== $awayScore && $self['awayScore'] = $awayScore;
    null !== $awayTeamID && $self['awayTeamID'] = $awayTeamID;
    null !== $date && $self['date'] = $date;
    null !== $episodeID && $self['episodeID'] = $episodeID;
    null !== $homeScore && $self['homeScore'] = $homeScore;
    null !== $homeTeamID && $self['homeTeamID'] = $homeTeamID;
    null !== $lessonLearned && $self['lessonLearned'] = $lessonLearned;
    null !== $matchType && $self['matchType'] = $matchType;
    null !== $possessionPercentage && $self['possessionPercentage'] = $possessionPercentage;
    null !== $result && $self['result'] = $result;
    null !== $tedHalftimeSpeech && $self['tedHalftimeSpeech'] = $tedHalftimeSpeech;
    null !== $ticketRevenueGbp && $self['ticketRevenueGbp'] = $ticketRevenueGbp;
    null !== $turningPoints && $self['turningPoints'] = $turningPoints;
    null !== $weatherTempCelsius && $self['weatherTempCelsius'] = $weatherTempCelsius;

    return $self;
  }

  /**
  * @param int|null $attendance
  *
  * @return self
 */
  public function withAttendance(?int $attendance): self {
    $self = clone $this;
    $self['attendance'] = $attendance;
    return $self;
  }

  /**
  * @param int|null $awayScore
  *
  * @return self
 */
  public function withAwayScore(?int $awayScore): self {
    $self = clone $this;
    $self['awayScore'] = $awayScore;
    return $self;
  }

  /**
  * @param string|null $awayTeamID
  *
  * @return self
 */
  public function withAwayTeamID(?string $awayTeamID): self {
    $self = clone $this;
    $self['awayTeamID'] = $awayTeamID;
    return $self;
  }

  /**
  * @param \DateTimeInterface|null $date
  *
  * @return self
 */
  public function withDate(?\DateTimeInterface $date): self {
    $self = clone $this;
    $self['date'] = $date;
    return $self;
  }

  /**
  * @param string|null $episodeID
  *
  * @return self
 */
  public function withEpisodeID(?string $episodeID): self {
    $self = clone $this;
    $self['episodeID'] = $episodeID;
    return $self;
  }

  /**
  * @param int|null $homeScore
  *
  * @return self
 */
  public function withHomeScore(?int $homeScore): self {
    $self = clone $this;
    $self['homeScore'] = $homeScore;
    return $self;
  }

  /**
  * @param string|null $homeTeamID
  *
  * @return self
 */
  public function withHomeTeamID(?string $homeTeamID): self {
    $self = clone $this;
    $self['homeTeamID'] = $homeTeamID;
    return $self;
  }

  /**
  * @param string|null $lessonLearned
  *
  * @return self
 */
  public function withLessonLearned(?string $lessonLearned): self {
    $self = clone $this;
    $self['lessonLearned'] = $lessonLearned;
    return $self;
  }

  /**
  * Types of matches.
  *
  * @param null|MatchType|value-of<MatchType> $matchType
  *
  * @return self
 */
  public function withMatchType(null|MatchType|string $matchType): self {
    $self = clone $this;
    $self['matchType'] = $matchType;
    return $self;
  }

  /**
  * @param float|null $possessionPercentage
  *
  * @return self
 */
  public function withPossessionPercentage(?float $possessionPercentage): self {
    $self = clone $this;
    $self['possessionPercentage'] = $possessionPercentage;
    return $self;
  }

  /**
  * Match result types.
  *
  * @param null|MatchResult|value-of<MatchResult> $result
  *
  * @return self
 */
  public function withResult(null|MatchResult|string $result): self {
    $self = clone $this;
    $self['result'] = $result;
    return $self;
  }

  /**
  * @param string|null $tedHalftimeSpeech
  *
  * @return self
 */
  public function withTedHalftimeSpeech(?string $tedHalftimeSpeech): self {
    $self = clone $this;
    $self['tedHalftimeSpeech'] = $tedHalftimeSpeech;
    return $self;
  }

  /**
  * @param TicketRevenueGbpShape|null $ticketRevenueGbp
  *
  * @return self
 */
  public function withTicketRevenueGbp(
    float|string|null $ticketRevenueGbp
  ): self {
    $self = clone $this;
    $self['ticketRevenueGbp'] = $ticketRevenueGbp;
    return $self;
  }

  /**
  * @param list<TurningPoint|TurningPointShape>|null $turningPoints
  *
  * @return self
 */
  public function withTurningPoints(?array $turningPoints): self {
    $self = clone $this;
    $self['turningPoints'] = $turningPoints;
    return $self;
  }

  /**
  * @param float|null $weatherTempCelsius
  *
  * @return self
 */
  public function withWeatherTempCelsius(?float $weatherTempCelsius): self {
    $self = clone $this;
    $self['weatherTempCelsius'] = $weatherTempCelsius;
    return $self;
  }
}
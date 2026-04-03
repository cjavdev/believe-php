<?php

declare(strict_types=1);

namespace Believe\Matches;

use Believe\Core\Attributes\Required;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Full match model with ID.
  * @phpstan-import-type TurningPointShape from \Believe\Matches\TurningPoint
  * @phpstan-type MatchShape = array{
  *   id: string,
  *   awayTeamID: string,
  *   date: \DateTimeInterface,
  *   homeTeamID: string,
  *   matchType: MatchType|value-of<MatchType>,
  *   attendance?: int|null,
  *   awayScore?: int|null,
  *   episodeID?: string|null,
  *   homeScore?: int|null,
  *   lessonLearned?: string|null,
  *   possessionPercentage?: float|null,
  *   result?: null|MatchResult|value-of<MatchResult>,
  *   tedHalftimeSpeech?: string|null,
  *   ticketRevenueGbp?: string|null,
  *   turningPoints?: list<TurningPoint|TurningPointShape>|null,
  *   weatherTempCelsius?: float|null,
  * }
  *
 */
final class Match_ implements BaseModel
{
  /** @use SdkModel<MatchShape> */
  use SdkModel;

  /**
  * Unique identifier
  *
  * @var string $id
 */
  #[Required]
  public string $id;

  /**
  * Away team ID
  *
  * @var string $awayTeamID
 */
  #[Required('away_team_id')]
  public string $awayTeamID;

  /**
  * Match date and time
  *
  * @var \DateTimeInterface $date
 */
  #[Required]
  public \DateTimeInterface $date;

  /**
  * Home team ID
  *
  * @var string $homeTeamID
 */
  #[Required('home_team_id')]
  public string $homeTeamID;

  /**
  * Type of match
  *
  * @var value-of<MatchType> $matchType
 */
  #[Required('match_type', enum: MatchType::class)]
  public string $matchType;

  /**
  * Match attendance
  *
  * @var int|null $attendance
 */
  #[Optional(nullable: true)]
  public ?int $attendance;

  /**
  * Away team score
  *
  * @var int|null $awayScore
 */
  #[Optional('away_score')]
  public ?int $awayScore;

  /**
  * Episode ID where this match is featured
  *
  * @var string|null $episodeID
 */
  #[Optional('episode_id', nullable: true)]
  public ?string $episodeID;

  /**
  * Home team score
  *
  * @var int|null $homeScore
 */
  #[Optional('home_score')]
  public ?int $homeScore;

  /**
  * The life lesson learned from this match
  *
  * @var string|null $lessonLearned
 */
  #[Optional('lesson_learned', nullable: true)]
  public ?string $lessonLearned;

  /**
  * Home team possession percentage
  *
  * @var float|null $possessionPercentage
 */
  #[Optional('possession_percentage', nullable: true)]
  public ?float $possessionPercentage;

  /**
  * Match result from home team perspective
  *
  * @var value-of<MatchResult>|null $result
 */
  #[Optional(enum: MatchResult::class)]
  public ?string $result;

  /**
  * Ted's inspirational halftime speech
  *
  * @var string|null $tedHalftimeSpeech
 */
  #[Optional('ted_halftime_speech', nullable: true)]
  public ?string $tedHalftimeSpeech;

  /**
  * Total ticket revenue in GBP
  *
  * @var string|null $ticketRevenueGbp
 */
  #[Optional('ticket_revenue_gbp', nullable: true)]
  public ?string $ticketRevenueGbp;

  /**
  * Key moments that changed the match
  *
  * @var list<TurningPoint>|null $turningPoints
 */
  #[Optional('turning_points', list: TurningPoint::class)]
  public ?array $turningPoints;

  /**
  * Temperature at kickoff in Celsius
  *
  * @var float|null $weatherTempCelsius
 */
  #[Optional('weather_temp_celsius', nullable: true)]
  public ?float $weatherTempCelsius;

  /**
  * `new Match_()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * Match_::with(
  *   id: ..., awayTeamID: ..., date: ..., homeTeamID: ..., matchType: ...
  * )
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new Match_)
  *   ->withID(...)
  *   ->withAwayTeamID(...)
  *   ->withDate(...)
  *   ->withHomeTeamID(...)
  *   ->withMatchType(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $id
  * @param string $awayTeamID
  * @param \DateTimeInterface $date
  * @param string $homeTeamID
  * @param MatchType|value-of<MatchType> $matchType
  * @param int|null $attendance
  * @param int|null $awayScore
  * @param string|null $episodeID
  * @param int|null $homeScore
  * @param string|null $lessonLearned
  * @param float|null $possessionPercentage
  * @param null|MatchResult|value-of<MatchResult> $result
  * @param string|null $tedHalftimeSpeech
  * @param string|null $ticketRevenueGbp
  * @param list<TurningPoint|TurningPointShape>|null $turningPoints
  * @param float|null $weatherTempCelsius
  *
  * @return self
 */
  public static function with(
    string $id,
    string $awayTeamID,
    \DateTimeInterface $date,
    string $homeTeamID,
    MatchType|string $matchType,
    ?int $attendance = null,
    int $awayScore = null,
    ?string $episodeID = null,
    int $homeScore = null,
    ?string $lessonLearned = null,
    ?float $possessionPercentage = null,
    MatchResult|string $result = null,
    ?string $tedHalftimeSpeech = null,
    ?string $ticketRevenueGbp = null,
    array $turningPoints = null,
    ?float $weatherTempCelsius = null,
  ): self {
    $self = new self;

    $self['id'] = $id;
    $self['awayTeamID'] = $awayTeamID;
    $self['date'] = $date;
    $self['homeTeamID'] = $homeTeamID;
    $self['matchType'] = $matchType;

    null !== $attendance && $self['attendance'] = $attendance;
    null !== $awayScore && $self['awayScore'] = $awayScore;
    null !== $episodeID && $self['episodeID'] = $episodeID;
    null !== $homeScore && $self['homeScore'] = $homeScore;
    null !== $lessonLearned && $self['lessonLearned'] = $lessonLearned;
    null !== $possessionPercentage && $self['possessionPercentage'] = $possessionPercentage;
    null !== $result && $self['result'] = $result;
    null !== $tedHalftimeSpeech && $self['tedHalftimeSpeech'] = $tedHalftimeSpeech;
    null !== $ticketRevenueGbp && $self['ticketRevenueGbp'] = $ticketRevenueGbp;
    null !== $turningPoints && $self['turningPoints'] = $turningPoints;
    null !== $weatherTempCelsius && $self['weatherTempCelsius'] = $weatherTempCelsius;

    return $self;
  }

  /**
  * Unique identifier
  *
  * @param string $id
  *
  * @return self
 */
  public function withID(string $id): self {
    $self = clone $this;
    $self['id'] = $id;
    return $self;
  }

  /**
  * Away team ID
  *
  * @param string $awayTeamID
  *
  * @return self
 */
  public function withAwayTeamID(string $awayTeamID): self {
    $self = clone $this;
    $self['awayTeamID'] = $awayTeamID;
    return $self;
  }

  /**
  * Match date and time
  *
  * @param \DateTimeInterface $date
  *
  * @return self
 */
  public function withDate(\DateTimeInterface $date): self {
    $self = clone $this;
    $self['date'] = $date;
    return $self;
  }

  /**
  * Home team ID
  *
  * @param string $homeTeamID
  *
  * @return self
 */
  public function withHomeTeamID(string $homeTeamID): self {
    $self = clone $this;
    $self['homeTeamID'] = $homeTeamID;
    return $self;
  }

  /**
  * Type of match
  *
  * @param MatchType|value-of<MatchType> $matchType
  *
  * @return self
 */
  public function withMatchType(MatchType|string $matchType): self {
    $self = clone $this;
    $self['matchType'] = $matchType;
    return $self;
  }

  /**
  * Match attendance
  *
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
  * Away team score
  *
  * @param int $awayScore
  *
  * @return self
 */
  public function withAwayScore(int $awayScore): self {
    $self = clone $this;
    $self['awayScore'] = $awayScore;
    return $self;
  }

  /**
  * Episode ID where this match is featured
  *
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
  * Home team score
  *
  * @param int $homeScore
  *
  * @return self
 */
  public function withHomeScore(int $homeScore): self {
    $self = clone $this;
    $self['homeScore'] = $homeScore;
    return $self;
  }

  /**
  * The life lesson learned from this match
  *
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
  * Home team possession percentage
  *
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
  * Match result from home team perspective
  *
  * @param MatchResult|value-of<MatchResult> $result
  *
  * @return self
 */
  public function withResult(MatchResult|string $result): self {
    $self = clone $this;
    $self['result'] = $result;
    return $self;
  }

  /**
  * Ted's inspirational halftime speech
  *
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
  * Total ticket revenue in GBP
  *
  * @param string|null $ticketRevenueGbp
  *
  * @return self
 */
  public function withTicketRevenueGbp(?string $ticketRevenueGbp): self {
    $self = clone $this;
    $self['ticketRevenueGbp'] = $ticketRevenueGbp;
    return $self;
  }

  /**
  * Key moments that changed the match
  *
  * @param list<TurningPoint|TurningPointShape> $turningPoints
  *
  * @return self
 */
  public function withTurningPoints(array $turningPoints): self {
    $self = clone $this;
    $self['turningPoints'] = $turningPoints;
    return $self;
  }

  /**
  * Temperature at kickoff in Celsius
  *
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
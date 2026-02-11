<?php

declare(strict_types=1);

namespace Believe\Matches;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Schedule a new match.
 *
 * @see Believe\Services\MatchesService::create()
 *
 * @phpstan-import-type TicketRevenueGbpVariants from \Believe\Matches\MatchCreateParams\TicketRevenueGbp
 * @phpstan-import-type TicketRevenueGbpShape from \Believe\Matches\MatchCreateParams\TicketRevenueGbp
 * @phpstan-import-type TurningPointShape from \Believe\Matches\TurningPoint
 *
 * @phpstan-type MatchCreateParamsShape = array{
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
 *   ticketRevenueGbp?: TicketRevenueGbpShape|null,
 *   turningPoints?: list<TurningPoint|TurningPointShape>|null,
 *   weatherTempCelsius?: float|null,
 * }
 */
final class MatchCreateParams implements BaseModel
{
    /** @use SdkModel<MatchCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Away team ID.
     */
    #[Required('away_team_id')]
    public string $awayTeamID;

    /**
     * Match date and time.
     */
    #[Required]
    public \DateTimeInterface $date;

    /**
     * Home team ID.
     */
    #[Required('home_team_id')]
    public string $homeTeamID;

    /**
     * Type of match.
     *
     * @var value-of<MatchType> $matchType
     */
    #[Required('match_type', enum: MatchType::class)]
    public string $matchType;

    /**
     * Match attendance.
     */
    #[Optional(nullable: true)]
    public ?int $attendance;

    /**
     * Away team score.
     */
    #[Optional('away_score')]
    public ?int $awayScore;

    /**
     * Episode ID where this match is featured.
     */
    #[Optional('episode_id', nullable: true)]
    public ?string $episodeID;

    /**
     * Home team score.
     */
    #[Optional('home_score')]
    public ?int $homeScore;

    /**
     * The life lesson learned from this match.
     */
    #[Optional('lesson_learned', nullable: true)]
    public ?string $lessonLearned;

    /**
     * Home team possession percentage.
     */
    #[Optional('possession_percentage', nullable: true)]
    public ?float $possessionPercentage;

    /**
     * Match result from home team perspective.
     *
     * @var value-of<MatchResult>|null $result
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $result;

    /**
     * Ted's inspirational halftime speech.
     */
    #[Optional('ted_halftime_speech', nullable: true)]
    public ?string $tedHalftimeSpeech;

    /**
     * Total ticket revenue in GBP.
     *
     * @var TicketRevenueGbpVariants|null $ticketRevenueGbp
     */
    #[Optional('ticket_revenue_gbp', nullable: true)]
    public float|string|null $ticketRevenueGbp;

    /**
     * Key moments that changed the match.
     *
     * @var list<TurningPoint>|null $turningPoints
     */
    #[Optional('turning_points', list: TurningPoint::class)]
    public ?array $turningPoints;

    /**
     * Temperature at kickoff in Celsius.
     */
    #[Optional('weather_temp_celsius', nullable: true)]
    public ?float $weatherTempCelsius;

    /**
     * `new MatchCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MatchCreateParams::with(
     *   awayTeamID: ..., date: ..., homeTeamID: ..., matchType: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MatchCreateParams)
     *   ->withAwayTeamID(...)
     *   ->withDate(...)
     *   ->withHomeTeamID(...)
     *   ->withMatchType(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param MatchType|value-of<MatchType> $matchType
     * @param MatchResult|value-of<MatchResult>|null $result
     * @param TicketRevenueGbpShape|null $ticketRevenueGbp
     * @param list<TurningPoint|TurningPointShape>|null $turningPoints
     */
    public static function with(
        string $awayTeamID,
        \DateTimeInterface $date,
        string $homeTeamID,
        MatchType|string $matchType,
        ?int $attendance = null,
        ?int $awayScore = null,
        ?string $episodeID = null,
        ?int $homeScore = null,
        ?string $lessonLearned = null,
        ?float $possessionPercentage = null,
        MatchResult|string|null $result = null,
        ?string $tedHalftimeSpeech = null,
        float|string|null $ticketRevenueGbp = null,
        ?array $turningPoints = null,
        ?float $weatherTempCelsius = null,
    ): self {
        $self = new self;

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
     * Away team ID.
     */
    public function withAwayTeamID(string $awayTeamID): self
    {
        $self = clone $this;
        $self['awayTeamID'] = $awayTeamID;

        return $self;
    }

    /**
     * Match date and time.
     */
    public function withDate(\DateTimeInterface $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    /**
     * Home team ID.
     */
    public function withHomeTeamID(string $homeTeamID): self
    {
        $self = clone $this;
        $self['homeTeamID'] = $homeTeamID;

        return $self;
    }

    /**
     * Type of match.
     *
     * @param MatchType|value-of<MatchType> $matchType
     */
    public function withMatchType(MatchType|string $matchType): self
    {
        $self = clone $this;
        $self['matchType'] = $matchType;

        return $self;
    }

    /**
     * Match attendance.
     */
    public function withAttendance(?int $attendance): self
    {
        $self = clone $this;
        $self['attendance'] = $attendance;

        return $self;
    }

    /**
     * Away team score.
     */
    public function withAwayScore(int $awayScore): self
    {
        $self = clone $this;
        $self['awayScore'] = $awayScore;

        return $self;
    }

    /**
     * Episode ID where this match is featured.
     */
    public function withEpisodeID(?string $episodeID): self
    {
        $self = clone $this;
        $self['episodeID'] = $episodeID;

        return $self;
    }

    /**
     * Home team score.
     */
    public function withHomeScore(int $homeScore): self
    {
        $self = clone $this;
        $self['homeScore'] = $homeScore;

        return $self;
    }

    /**
     * The life lesson learned from this match.
     */
    public function withLessonLearned(?string $lessonLearned): self
    {
        $self = clone $this;
        $self['lessonLearned'] = $lessonLearned;

        return $self;
    }

    /**
     * Home team possession percentage.
     */
    public function withPossessionPercentage(?float $possessionPercentage): self
    {
        $self = clone $this;
        $self['possessionPercentage'] = $possessionPercentage;

        return $self;
    }

    /**
     * Match result from home team perspective.
     *
     * @param MatchResult|value-of<MatchResult> $result
     */
    public function withResult(MatchResult|string $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }

    /**
     * Ted's inspirational halftime speech.
     */
    public function withTedHalftimeSpeech(?string $tedHalftimeSpeech): self
    {
        $self = clone $this;
        $self['tedHalftimeSpeech'] = $tedHalftimeSpeech;

        return $self;
    }

    /**
     * Total ticket revenue in GBP.
     *
     * @param TicketRevenueGbpShape|null $ticketRevenueGbp
     */
    public function withTicketRevenueGbp(
        float|string|null $ticketRevenueGbp
    ): self {
        $self = clone $this;
        $self['ticketRevenueGbp'] = $ticketRevenueGbp;

        return $self;
    }

    /**
     * Key moments that changed the match.
     *
     * @param list<TurningPoint|TurningPointShape> $turningPoints
     */
    public function withTurningPoints(array $turningPoints): self
    {
        $self = clone $this;
        $self['turningPoints'] = $turningPoints;

        return $self;
    }

    /**
     * Temperature at kickoff in Celsius.
     */
    public function withWeatherTempCelsius(?float $weatherTempCelsius): self
    {
        $self = clone $this;
        $self['weatherTempCelsius'] = $weatherTempCelsius;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Exceptions\APIException;
use Believe\Matches\Match_;
use Believe\Matches\MatchResult;
use Believe\Matches\MatchType;
use Believe\Matches\TurningPoint;
use Believe\RequestOptions;
use Believe\SkipLimitPage;

/**
 * @phpstan-import-type TicketRevenueGbpShape from \Believe\Matches\MatchCreateParams\TicketRevenueGbp
 * @phpstan-import-type TicketRevenueGbpShape from \Believe\Matches\MatchUpdateParams\TicketRevenueGbp as TicketRevenueGbpShape1
 * @phpstan-import-type TurningPointShape from \Believe\Matches\TurningPoint
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface MatchesContract
{
    /**
     * @api
     *
     * @param string $awayTeamID Away team ID
     * @param \DateTimeInterface $date Match date and time
     * @param string $homeTeamID Home team ID
     * @param MatchType|value-of<MatchType> $matchType Type of match
     * @param int|null $attendance Match attendance
     * @param int $awayScore Away team score
     * @param string|null $episodeID Episode ID where this match is featured
     * @param int $homeScore Home team score
     * @param string|null $lessonLearned The life lesson learned from this match
     * @param float|null $possessionPercentage Home team possession percentage
     * @param MatchResult|value-of<MatchResult> $result Match result from home team perspective
     * @param string|null $tedHalftimeSpeech Ted's inspirational halftime speech
     * @param TicketRevenueGbpShape|null $ticketRevenueGbp Total ticket revenue in GBP
     * @param list<TurningPoint|TurningPointShape> $turningPoints Key moments that changed the match
     * @param float|null $weatherTempCelsius Temperature at kickoff in Celsius
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $awayTeamID,
        \DateTimeInterface $date,
        string $homeTeamID,
        MatchType|string $matchType,
        ?int $attendance = null,
        int $awayScore = 0,
        ?string $episodeID = null,
        int $homeScore = 0,
        ?string $lessonLearned = null,
        ?float $possessionPercentage = null,
        MatchResult|string|null $result = null,
        ?string $tedHalftimeSpeech = null,
        float|string|null $ticketRevenueGbp = null,
        ?array $turningPoints = null,
        ?float $weatherTempCelsius = null,
        RequestOptions|array|null $requestOptions = null,
    ): Match_;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $matchID,
        RequestOptions|array|null $requestOptions = null
    ): Match_;

    /**
     * @api
     *
     * @param MatchType|value-of<MatchType>|null $matchType types of matches
     * @param MatchResult|value-of<MatchResult>|null $result match result types
     * @param TicketRevenueGbpShape1|null $ticketRevenueGbp
     * @param list<TurningPoint|TurningPointShape>|null $turningPoints
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $matchID,
        ?int $attendance = null,
        ?int $awayScore = null,
        ?string $awayTeamID = null,
        ?\DateTimeInterface $date = null,
        ?string $episodeID = null,
        ?int $homeScore = null,
        ?string $homeTeamID = null,
        ?string $lessonLearned = null,
        MatchType|string|null $matchType = null,
        ?float $possessionPercentage = null,
        MatchResult|string|null $result = null,
        ?string $tedHalftimeSpeech = null,
        float|string|null $ticketRevenueGbp = null,
        ?array $turningPoints = null,
        ?float $weatherTempCelsius = null,
        RequestOptions|array|null $requestOptions = null,
    ): Match_;

    /**
     * @api
     *
     * @param int $limit Maximum number of items to return (max: 100)
     * @param MatchType|value-of<MatchType>|null $matchType Filter by match type
     * @param MatchResult|value-of<MatchResult>|null $result Filter by result
     * @param int $skip Number of items to skip (offset)
     * @param string|null $teamID Filter by team (home or away)
     * @param RequestOpts|null $requestOptions
     *
     * @return SkipLimitPage<Match_>
     *
     * @throws APIException
     */
    public function list(
        int $limit = 20,
        MatchType|string|null $matchType = null,
        MatchResult|string|null $result = null,
        int $skip = 0,
        ?string $teamID = null,
        RequestOptions|array|null $requestOptions = null,
    ): SkipLimitPage;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $matchID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return array<string,mixed>
     *
     * @throws APIException
     */
    public function getLesson(
        string $matchID,
        RequestOptions|array|null $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<array<string,mixed>>
     *
     * @throws APIException
     */
    public function getTurningPoints(
        string $matchID,
        RequestOptions|array|null $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param string $awayTeam Away team name
     * @param int $excitementLevel How eventful the match should be (1=boring, 10=chaos)
     * @param string $homeTeam Home team name
     * @param float $speed Simulation speed multiplier (1.0 = real-time)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function streamLive(
        string $awayTeam = 'West Ham United',
        int $excitementLevel = 5,
        string $homeTeam = 'AFC Richmond',
        float $speed = 1,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;
}

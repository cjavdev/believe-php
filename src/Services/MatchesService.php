<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Client;
use Believe\Core\Util;
use Believe\Core\Exceptions\APIException;
use Believe\Matches\MatchType;
use Believe\Matches\MatchResult;
use Believe\Matches\TurningPoint;
use Believe\Matches\Match_;
use Believe\ServiceContracts\MatchesContract;
use Believe\Services\Matches\CommentaryService;

/**
  * @phpstan-import-type TicketRevenueGbpShape from \Believe\Matches\MatchCreateParams\TicketRevenueGbp
  * @phpstan-import-type TicketRevenueGbpShape from \Believe\Matches\MatchUpdateParams\TicketRevenueGbp as TicketRevenueGbpShape1
  * @phpstan-import-type TurningPointShape from \Believe\Matches\TurningPoint
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class MatchesService implements MatchesContract
{
  /**
  * @api
  *
  * @var MatchesRawService $raw
 */
  public MatchesRawService $raw;

  /**
  * @api
  *
  * @var CommentaryService $commentary
 */
  public CommentaryService $commentary;

  /**
  * @api
  *
  * Schedule a new match.
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
  * @return Match_
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
    MatchResult|string $result = null,
    ?string $tedHalftimeSpeech = null,
    float|string|null $ticketRevenueGbp = null,
    array $turningPoints = null,
    ?float $weatherTempCelsius = null,
    null|RequestOptions|array $requestOptions = null,
  ): Match_ {
    $params = Util::removeNulls(
      [
        'awayTeamID' => $awayTeamID,
        'date' => $date,
        'homeTeamID' => $homeTeamID,
        'matchType' => $matchType,
        'attendance' => $attendance,
        'awayScore' => $awayScore,
        'episodeID' => $episodeID,
        'homeScore' => $homeScore,
        'lessonLearned' => $lessonLearned,
        'possessionPercentage' => $possessionPercentage,
        'result' => $result,
        'tedHalftimeSpeech' => $tedHalftimeSpeech,
        'ticketRevenueGbp' => $ticketRevenueGbp,
        'turningPoints' => $turningPoints,
        'weatherTempCelsius' => $weatherTempCelsius,
      ],
    );

    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @api
  *
  * Retrieve detailed information about a specific match.
  *
  * @param string $matchID
  * @param RequestOpts|null $requestOptions
  *
  * @return Match_
  *
  * @throws APIException
 */
  public function retrieve(
    string $matchID, null|RequestOptions|array $requestOptions = null
  ): Match_ {
    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->retrieve($matchID, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @api
  *
  * Update specific fields of an existing match (e.g., update score).
  *
  * @param string $matchID
  * @param int|null $attendance
  * @param int|null $awayScore
  * @param string|null $awayTeamID
  * @param \DateTimeInterface|null $date
  * @param string|null $episodeID
  * @param int|null $homeScore
  * @param string|null $homeTeamID
  * @param string|null $lessonLearned
  * @param null|MatchType|value-of<MatchType> $matchType Types of matches.
  * @param float|null $possessionPercentage
  * @param null|MatchResult|value-of<MatchResult> $result Match result types.
  * @param string|null $tedHalftimeSpeech
  * @param TicketRevenueGbpShape1|null $ticketRevenueGbp
  * @param list<TurningPoint|TurningPointShape>|null $turningPoints
  * @param float|null $weatherTempCelsius
  * @param RequestOpts|null $requestOptions
  *
  * @return Match_
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
    null|MatchType|string $matchType = null,
    ?float $possessionPercentage = null,
    null|MatchResult|string $result = null,
    ?string $tedHalftimeSpeech = null,
    float|string|null $ticketRevenueGbp = null,
    ?array $turningPoints = null,
    ?float $weatherTempCelsius = null,
    null|RequestOptions|array $requestOptions = null,
  ): Match_ {
    $params = Util::removeNulls(
      [
        'attendance' => $attendance,
        'awayScore' => $awayScore,
        'awayTeamID' => $awayTeamID,
        'date' => $date,
        'episodeID' => $episodeID,
        'homeScore' => $homeScore,
        'homeTeamID' => $homeTeamID,
        'lessonLearned' => $lessonLearned,
        'matchType' => $matchType,
        'possessionPercentage' => $possessionPercentage,
        'result' => $result,
        'tedHalftimeSpeech' => $tedHalftimeSpeech,
        'ticketRevenueGbp' => $ticketRevenueGbp,
        'turningPoints' => $turningPoints,
        'weatherTempCelsius' => $weatherTempCelsius,
      ],
    );

    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->update($matchID, params: $params, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @api
  *
  * Get a paginated list of all matches with optional filtering.
  *
  * @param int $limit Maximum number of items to return (max: 100)
  * @param null|MatchType|value-of<MatchType> $matchType Filter by match type
  * @param null|MatchResult|value-of<MatchResult> $result Filter by result
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
    null|MatchType|string $matchType = null,
    null|MatchResult|string $result = null,
    int $skip = 0,
    ?string $teamID = null,
    null|RequestOptions|array $requestOptions = null,
  ): SkipLimitPage {
    $params = Util::removeNulls(
      [
        'limit' => $limit,
        'matchType' => $matchType,
        'result' => $result,
        'skip' => $skip,
        'teamID' => $teamID,
      ],
    );

    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @api
  *
  * Remove a match from the database.
  *
  * @param string $matchID
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
  public function delete(
    string $matchID, null|RequestOptions|array $requestOptions = null
  ): mixed {
    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->delete($matchID, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @api
  *
  * Get the life lesson learned from a specific match.
  *
  * @param string $matchID
  * @param RequestOpts|null $requestOptions
  *
  * @return array<string,mixed>
  *
  * @throws APIException
 */
  public function getLesson(
    string $matchID, null|RequestOptions|array $requestOptions = null
  ): array {
    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->getLesson($matchID, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @api
  *
  * Get all turning points from a specific match.
  *
  * @param string $matchID
  * @param RequestOpts|null $requestOptions
  *
  * @return list<array<string,mixed>>
  *
  * @throws APIException
 */
  public function getTurningPoints(
    string $matchID, null|RequestOptions|array $requestOptions = null
  ): array {
    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->getTurningPoints($matchID, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @api
  *
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
  *
  * @param string $awayTeam Away team name
  * @param int $excitementLevel How eventful the match should be (1=boring, 10=chaos)
  * @param string $homeTeam Home team name
  * @param float $speed Simulation speed multiplier (1.0 = real-time)
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
  public function streamLive(
    string $awayTeam = 'West Ham United',
    int $excitementLevel = 5,
    string $homeTeam = 'AFC Richmond',
    float $speed = 1,
    null|RequestOptions|array $requestOptions = null,
  ): mixed {
    $params = Util::removeNulls(
      [
        'awayTeam' => $awayTeam,
        'excitementLevel' => $excitementLevel,
        'homeTeam' => $homeTeam,
        'speed' => $speed,
      ],
    );

    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->streamLive(params: $params, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new MatchesRawService($client);
    $this->commentary = new CommentaryService($client);
  }
}
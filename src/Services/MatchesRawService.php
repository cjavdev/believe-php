<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Client;
use Believe\Core\Util;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Conversion\ListOf;
use Believe\Core\Conversion\MapOf;
use Believe\Core\Exceptions\APIException;
use Believe\Matches\MatchType;
use Believe\Matches\MatchResult;
use Believe\Matches\TurningPoint;
use Believe\Matches\MatchCreateParams;
use Believe\Matches\Match_;
use Believe\Matches\MatchUpdateParams;
use Believe\Matches\MatchListParams;
use Believe\Matches\MatchStreamLiveParams;
use Believe\ServiceContracts\MatchesRawContract;

/**
  * @phpstan-import-type TicketRevenueGbpShape from \Believe\Matches\MatchCreateParams\TicketRevenueGbp
  * @phpstan-import-type TicketRevenueGbpShape from \Believe\Matches\MatchUpdateParams\TicketRevenueGbp as TicketRevenueGbpShape1
  * @phpstan-import-type TurningPointShape from \Believe\Matches\TurningPoint
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class MatchesRawService implements MatchesRawContract
{
  /**
  * @api
  *
  * Schedule a new match.
  *
  * @param array{
  *   awayTeamID: string,
  *   date: \DateTimeInterface,
  *   homeTeamID: string,
  *   matchType: MatchType|value-of<MatchType>,
  *   attendance?: int|null,
  *   awayScore?: int,
  *   episodeID?: string|null,
  *   homeScore?: int,
  *   lessonLearned?: string|null,
  *   possessionPercentage?: float|null,
  *   result?: MatchResult|value-of<MatchResult>,
  *   tedHalftimeSpeech?: string|null,
  *   ticketRevenueGbp?: TicketRevenueGbpShape|null,
  *   turningPoints?: list<TurningPoint|TurningPointShape>,
  *   weatherTempCelsius?: float|null,
  * }|MatchCreateParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Match_>
  *
  * @throws APIException
 */
  public function create(
    array|MatchCreateParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = MatchCreateParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'post',
      path: 'matches',
      body: (object) $parsed,
      options: $options,
      convert: Match_::class,
    );
  }

  /**
  * @api
  *
  * Retrieve detailed information about a specific match.
  *
  * @param string $matchID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Match_>
  *
  * @throws APIException
 */
  public function retrieve(
    string $matchID, null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: ['matches/%1$s', $matchID],
      options: $requestOptions,
      convert: Match_::class,
    );
  }

  /**
  * @api
  *
  * Update specific fields of an existing match (e.g., update score).
  *
  * @param string $matchID
  * @param array{
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
  *   ticketRevenueGbp?: TicketRevenueGbpShape1|null,
  *   turningPoints?: list<TurningPoint|TurningPointShape>|null,
  *   weatherTempCelsius?: float|null,
  * }|MatchUpdateParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Match_>
  *
  * @throws APIException
 */
  public function update(
    string $matchID,
    array|MatchUpdateParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = MatchUpdateParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'patch',
      path: ['matches/%1$s', $matchID],
      body: (object) $parsed,
      options: $options,
      convert: Match_::class,
    );
  }

  /**
  * @api
  *
  * Get a paginated list of all matches with optional filtering.
  *
  * @param array{
  *   limit?: int,
  *   matchType?: null|MatchType|value-of<MatchType>,
  *   result?: null|MatchResult|value-of<MatchResult>,
  *   skip?: int,
  *   teamID?: string|null,
  * }|MatchListParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<SkipLimitPage<Match_>>
  *
  * @throws APIException
 */
  public function list(
    array|MatchListParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = MatchListParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: 'matches',
      query: Util::array_transform_keys(
        $parsed, ['matchType' => 'match_type', 'teamID' => 'team_id']
      ),
      options: $options,
      convert: Match_::class,
      page: SkipLimitPage::class,
    );
  }

  /**
  * @api
  *
  * Remove a match from the database.
  *
  * @param string $matchID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
  public function delete(
    string $matchID, null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'delete',
      path: ['matches/%1$s', $matchID],
      options: $requestOptions,
      convert: null,
    );
  }

  /**
  * @api
  *
  * Get the life lesson learned from a specific match.
  *
  * @param string $matchID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<array<string,mixed>>
  *
  * @throws APIException
 */
  public function getLesson(
    string $matchID, null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: ['matches/%1$s/lesson', $matchID],
      options: $requestOptions,
      convert: new MapOf('mixed'),
    );
  }

  /**
  * @api
  *
  * Get all turning points from a specific match.
  *
  * @param string $matchID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<list<array<string,mixed>>>
  *
  * @throws APIException
 */
  public function getTurningPoints(
    string $matchID, null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: ['matches/%1$s/turning-points', $matchID],
      options: $requestOptions,
      convert: new ListOf(new MapOf('mixed')),
    );
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
  * @param array{
  *   awayTeam?: string, excitementLevel?: int, homeTeam?: string, speed?: float
  * }|MatchStreamLiveParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
  public function streamLive(
    array|MatchStreamLiveParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = MatchStreamLiveParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: 'matches/live',
      query: Util::array_transform_keys(
        $parsed,
        [
          'awayTeam' => 'away_team',
          'excitementLevel' => 'excitement_level',
          'homeTeam' => 'home_team',
        ],
      ),
      options: $options,
      convert: null,
    );
  }

  // @phpstan-ignore-next-line
  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {}
}
<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Conversion\ListOf;
use Believe\Core\Conversion\MapOf;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\RequestOptions;
use Believe\ServiceContracts\TeamsRawContract;
use Believe\SkipLimitPage;
use Believe\Teams\GeoLocation;
use Believe\Teams\League;
use Believe\Teams\Logo\FileUpload;
use Believe\Teams\Team;
use Believe\Teams\TeamCreateParams;
use Believe\Teams\TeamListParams;
use Believe\Teams\TeamUpdateParams;
use Believe\Teams\TeamValues;

/**
 * Operations related to football teams.
 *
 * @phpstan-import-type AnnualBudgetGbpShape from \Believe\Teams\TeamCreateParams\AnnualBudgetGbp
 * @phpstan-import-type AnnualBudgetGbpShape from \Believe\Teams\TeamUpdateParams\AnnualBudgetGbp as AnnualBudgetGbpShape1
 * @phpstan-import-type TeamValuesShape from \Believe\Teams\TeamValues
 * @phpstan-import-type GeoLocationShape from \Believe\Teams\GeoLocation
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class TeamsRawService implements TeamsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Add a new team to the league.
     *
     * @param array{
     *   cultureScore: int,
     *   foundedYear: int,
     *   league: value-of<League>,
     *   name: string,
     *   stadium: string,
     *   values: TeamValues|TeamValuesShape,
     *   annualBudgetGbp?: AnnualBudgetGbpShape|null,
     *   averageAttendance?: float|null,
     *   contactEmail?: string|null,
     *   isActive?: bool,
     *   nickname?: string|null,
     *   primaryColor?: string|null,
     *   rivalTeams?: list<string>,
     *   secondaryColor?: string|null,
     *   stadiumLocation?: GeoLocation|GeoLocationShape|null,
     *   website?: string|null,
     *   winPercentage?: float|null,
     * }|TeamCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Team>
     *
     * @throws APIException
     */
    public function create(
        array|TeamCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TeamCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'teams',
            body: (object) $parsed,
            options: $options,
            convert: Team::class,
        );
    }

    /**
     * @api
     *
     * Retrieve detailed information about a specific team.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Team>
     *
     * @throws APIException
     */
    public function retrieve(
        string $teamID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['teams/%1$s', $teamID],
            options: $requestOptions,
            convert: Team::class,
        );
    }

    /**
     * @api
     *
     * Update specific fields of an existing team.
     *
     * @param array{
     *   annualBudgetGbp?: AnnualBudgetGbpShape1|null,
     *   averageAttendance?: float|null,
     *   contactEmail?: string|null,
     *   cultureScore?: int|null,
     *   foundedYear?: int|null,
     *   isActive?: bool|null,
     *   league?: value-of<League>,
     *   name?: string|null,
     *   nickname?: string|null,
     *   primaryColor?: string|null,
     *   rivalTeams?: list<string>|null,
     *   secondaryColor?: string|null,
     *   stadium?: string|null,
     *   stadiumLocation?: GeoLocation|GeoLocationShape|null,
     *   values?: TeamValues|TeamValuesShape|null,
     *   website?: string|null,
     *   winPercentage?: float|null,
     * }|TeamUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Team>
     *
     * @throws APIException
     */
    public function update(
        string $teamID,
        array|TeamUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TeamUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['teams/%1$s', $teamID],
            body: (object) $parsed,
            options: $options,
            convert: Team::class,
        );
    }

    /**
     * @api
     *
     * Get a paginated list of all teams with optional filtering by league or culture score.
     *
     * @param array{
     *   league?: value-of<League>, limit?: int, minCultureScore?: int|null, skip?: int
     * }|TeamListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<Team>>
     *
     * @throws APIException
     */
    public function list(
        array|TeamListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TeamListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'teams',
            query: Util::array_transform_keys(
                $parsed,
                ['minCultureScore' => 'min_culture_score']
            ),
            options: $options,
            convert: Team::class,
            page: SkipLimitPage::class,
        );
    }

    /**
     * @api
     *
     * Remove a team from the database (relegation to oblivion).
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $teamID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['teams/%1$s', $teamID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get detailed culture and values information for a team.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<array<string,mixed>>
     *
     * @throws APIException
     */
    public function getCulture(
        string $teamID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['teams/%1$s/culture', $teamID],
            options: $requestOptions,
            convert: new MapOf('mixed'),
        );
    }

    /**
     * @api
     *
     * Get all rival teams for a specific team.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<Team>>
     *
     * @throws APIException
     */
    public function getRivals(
        string $teamID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['teams/%1$s/rivals', $teamID],
            options: $requestOptions,
            convert: new ListOf(Team::class),
        );
    }

    /**
     * @api
     *
     * List all uploaded logos for a team.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<FileUpload>>
     *
     * @throws APIException
     */
    public function listLogos(
        string $teamID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['teams/%1$s/logos', $teamID],
            options: $requestOptions,
            convert: new ListOf(FileUpload::class),
        );
    }
}

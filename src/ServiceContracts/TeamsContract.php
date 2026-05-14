<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Teams\GeoLocation;
use Believe\Teams\League;
use Believe\Teams\Logo\FileUpload;
use Believe\Teams\Team;
use Believe\Teams\TeamValues;

/**
 * @phpstan-import-type AnnualBudgetGbpShape from \Believe\Teams\TeamCreateParams\AnnualBudgetGbp
 * @phpstan-import-type AnnualBudgetGbpShape from \Believe\Teams\TeamUpdateParams\AnnualBudgetGbp as AnnualBudgetGbpShape1
 * @phpstan-import-type TeamValuesShape from \Believe\Teams\TeamValues
 * @phpstan-import-type GeoLocationShape from \Believe\Teams\GeoLocation
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface TeamsContract
{
    /**
     * @api
     *
     * @param int $cultureScore Team culture/morale score (0-100)
     * @param int $foundedYear Year the club was founded
     * @param League|value-of<League> $league Current league
     * @param string $name Team name
     * @param string $stadium Home stadium name
     * @param TeamValues|TeamValuesShape $values Team's core values
     * @param AnnualBudgetGbpShape|null $annualBudgetGbp Annual budget in GBP
     * @param float|null $averageAttendance Average match attendance
     * @param string|null $contactEmail Team contact email
     * @param bool $isActive Whether the team is currently active
     * @param string|null $nickname Team nickname
     * @param string|null $primaryColor Primary team color (hex)
     * @param list<string> $rivalTeams List of rival team IDs
     * @param string|null $secondaryColor Secondary team color (hex)
     * @param GeoLocation|GeoLocationShape|null $stadiumLocation geographic coordinates for a location
     * @param string|null $website Official team website
     * @param float|null $winPercentage Season win percentage
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        int $cultureScore,
        int $foundedYear,
        League|string $league,
        string $name,
        string $stadium,
        TeamValues|array $values,
        float|string|null $annualBudgetGbp = null,
        ?float $averageAttendance = null,
        ?string $contactEmail = null,
        bool $isActive = true,
        ?string $nickname = null,
        ?string $primaryColor = null,
        ?array $rivalTeams = null,
        ?string $secondaryColor = null,
        GeoLocation|array|null $stadiumLocation = null,
        ?string $website = null,
        ?float $winPercentage = null,
        RequestOptions|array|null $requestOptions = null,
    ): Team;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $teamID,
        RequestOptions|array|null $requestOptions = null
    ): Team;

    /**
     * @api
     *
     * @param AnnualBudgetGbpShape1|null $annualBudgetGbp
     * @param League|value-of<League>|null $league football leagues
     * @param list<string>|null $rivalTeams
     * @param GeoLocation|GeoLocationShape|null $stadiumLocation geographic coordinates for a location
     * @param TeamValues|TeamValuesShape|null $values core values that define a team's culture
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $teamID,
        float|string|null $annualBudgetGbp = null,
        ?float $averageAttendance = null,
        ?string $contactEmail = null,
        ?int $cultureScore = null,
        ?int $foundedYear = null,
        ?bool $isActive = null,
        League|string|null $league = null,
        ?string $name = null,
        ?string $nickname = null,
        ?string $primaryColor = null,
        ?array $rivalTeams = null,
        ?string $secondaryColor = null,
        ?string $stadium = null,
        GeoLocation|array|null $stadiumLocation = null,
        TeamValues|array|null $values = null,
        ?string $website = null,
        ?float $winPercentage = null,
        RequestOptions|array|null $requestOptions = null,
    ): Team;

    /**
     * @api
     *
     * @param League|value-of<League>|null $league Filter by league
     * @param int $limit Maximum number of items to return (max: 100)
     * @param int|null $minCultureScore Minimum culture score
     * @param int $skip Number of items to skip (offset)
     * @param RequestOpts|null $requestOptions
     *
     * @return SkipLimitPage<Team>
     *
     * @throws APIException
     */
    public function list(
        League|string|null $league = null,
        int $limit = 20,
        ?int $minCultureScore = null,
        int $skip = 0,
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
        string $teamID,
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
    public function getCulture(
        string $teamID,
        RequestOptions|array|null $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<Team>
     *
     * @throws APIException
     */
    public function getRivals(
        string $teamID,
        RequestOptions|array|null $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<FileUpload>
     *
     * @throws APIException
     */
    public function listLogos(
        string $teamID,
        RequestOptions|array|null $requestOptions = null
    ): array;
}

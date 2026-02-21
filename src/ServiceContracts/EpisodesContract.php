<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Exceptions\APIException;
use Believe\Episodes\Episode;
use Believe\RequestOptions;
use Believe\SkipLimitPage;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface EpisodesContract
{
    /**
     * @api
     *
     * @param string $airDate Original air date
     * @param list<string> $characterFocus Characters with significant development
     * @param string $director Episode director
     * @param int $episodeNumber Episode number within season
     * @param string $mainTheme Central theme of the episode
     * @param int $runtimeMinutes Episode runtime in minutes
     * @param int $season Season number
     * @param string $synopsis Brief plot synopsis
     * @param string $tedWisdom Key piece of Ted wisdom from the episode
     * @param string $title Episode title
     * @param string $writer Episode writer(s)
     * @param string|null $biscuitsWithBossMoment Notable biscuits with the boss scene
     * @param list<string> $memorableMoments Standout moments from the episode
     * @param float|null $usViewersMillions US viewership in millions
     * @param float|null $viewerRating Viewer rating out of 10
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $airDate,
        array $characterFocus,
        string $director,
        int $episodeNumber,
        string $mainTheme,
        int $runtimeMinutes,
        int $season,
        string $synopsis,
        string $tedWisdom,
        string $title,
        string $writer,
        ?string $biscuitsWithBossMoment = null,
        ?array $memorableMoments = null,
        ?float $usViewersMillions = null,
        ?float $viewerRating = null,
        RequestOptions|array|null $requestOptions = null,
    ): Episode;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $episodeID,
        RequestOptions|array|null $requestOptions = null
    ): Episode;

    /**
     * @api
     *
     * @param list<string>|null $characterFocus
     * @param list<string>|null $memorableMoments
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $episodeID,
        ?string $airDate = null,
        ?string $biscuitsWithBossMoment = null,
        ?array $characterFocus = null,
        ?string $director = null,
        ?int $episodeNumber = null,
        ?string $mainTheme = null,
        ?array $memorableMoments = null,
        ?int $runtimeMinutes = null,
        ?int $season = null,
        ?string $synopsis = null,
        ?string $tedWisdom = null,
        ?string $title = null,
        ?float $usViewersMillions = null,
        ?float $viewerRating = null,
        ?string $writer = null,
        RequestOptions|array|null $requestOptions = null,
    ): Episode;

    /**
     * @api
     *
     * @param string|null $characterFocus Filter by character focus (character ID)
     * @param int $limit Maximum number of items to return (max: 100)
     * @param int|null $season Filter by season
     * @param int $skip Number of items to skip (offset)
     * @param RequestOpts|null $requestOptions
     *
     * @return SkipLimitPage<Episode>
     *
     * @throws APIException
     */
    public function list(
        ?string $characterFocus = null,
        int $limit = 20,
        ?int $season = null,
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
        string $episodeID,
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
    public function getWisdom(
        string $episodeID,
        RequestOptions|array|null $requestOptions = null
    ): array;
}

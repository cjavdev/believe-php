<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\Episodes\Episode;
use Believe\RequestOptions;
use Believe\ServiceContracts\EpisodesContract;
use Believe\SkipLimitPage;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class EpisodesService implements EpisodesContract
{
    /**
     * @api
     */
    public EpisodesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new EpisodesRawService($client);
    }

    /**
     * @api
     *
     * Add a new episode to the series.
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
    ): Episode {
        $params = Util::removeNulls(
            [
                'airDate' => $airDate,
                'characterFocus' => $characterFocus,
                'director' => $director,
                'episodeNumber' => $episodeNumber,
                'mainTheme' => $mainTheme,
                'runtimeMinutes' => $runtimeMinutes,
                'season' => $season,
                'synopsis' => $synopsis,
                'tedWisdom' => $tedWisdom,
                'title' => $title,
                'writer' => $writer,
                'biscuitsWithBossMoment' => $biscuitsWithBossMoment,
                'memorableMoments' => $memorableMoments,
                'usViewersMillions' => $usViewersMillions,
                'viewerRating' => $viewerRating,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve detailed information about a specific episode.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $episodeID,
        RequestOptions|array|null $requestOptions = null
    ): Episode {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($episodeID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update specific fields of an existing episode.
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
    ): Episode {
        $params = Util::removeNulls(
            [
                'airDate' => $airDate,
                'biscuitsWithBossMoment' => $biscuitsWithBossMoment,
                'characterFocus' => $characterFocus,
                'director' => $director,
                'episodeNumber' => $episodeNumber,
                'mainTheme' => $mainTheme,
                'memorableMoments' => $memorableMoments,
                'runtimeMinutes' => $runtimeMinutes,
                'season' => $season,
                'synopsis' => $synopsis,
                'tedWisdom' => $tedWisdom,
                'title' => $title,
                'usViewersMillions' => $usViewersMillions,
                'viewerRating' => $viewerRating,
                'writer' => $writer,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($episodeID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a paginated list of all Ted Lasso episodes with optional filtering by season.
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
    ): SkipLimitPage {
        $params = Util::removeNulls(
            [
                'characterFocus' => $characterFocus,
                'limit' => $limit,
                'season' => $season,
                'skip' => $skip,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Remove an episode from the database.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $episodeID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($episodeID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get Ted's wisdom and memorable moments from a specific episode.
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
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getWisdom($episodeID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

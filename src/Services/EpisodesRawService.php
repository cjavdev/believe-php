<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Conversion\MapOf;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\Episodes\Episode;
use Believe\Episodes\EpisodeCreateParams;
use Believe\Episodes\EpisodeListParams;
use Believe\Episodes\EpisodeUpdateParams;
use Believe\RequestOptions;
use Believe\ServiceContracts\EpisodesRawContract;
use Believe\SkipLimitPage;

/**
 * Operations related to TV episodes.
 *
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class EpisodesRawService implements EpisodesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Add a new episode to the series.
     *
     * @param array{
     *   airDate: string,
     *   characterFocus: list<string>,
     *   director: string,
     *   episodeNumber: int,
     *   mainTheme: string,
     *   runtimeMinutes: int,
     *   season: int,
     *   synopsis: string,
     *   tedWisdom: string,
     *   title: string,
     *   writer: string,
     *   biscuitsWithBossMoment?: string|null,
     *   memorableMoments?: list<string>,
     *   usViewersMillions?: float|null,
     *   viewerRating?: float|null,
     * }|EpisodeCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Episode>
     *
     * @throws APIException
     */
    public function create(
        array|EpisodeCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EpisodeCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'episodes',
            body: (object) $parsed,
            options: $options,
            convert: Episode::class,
        );
    }

    /**
     * @api
     *
     * Retrieve detailed information about a specific episode.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Episode>
     *
     * @throws APIException
     */
    public function retrieve(
        string $episodeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['episodes/%1$s', $episodeID],
            options: $requestOptions,
            convert: Episode::class,
        );
    }

    /**
     * @api
     *
     * Update specific fields of an existing episode.
     *
     * @param array{
     *   airDate?: string|null,
     *   biscuitsWithBossMoment?: string|null,
     *   characterFocus?: list<string>|null,
     *   director?: string|null,
     *   episodeNumber?: int|null,
     *   mainTheme?: string|null,
     *   memorableMoments?: list<string>|null,
     *   runtimeMinutes?: int|null,
     *   season?: int|null,
     *   synopsis?: string|null,
     *   tedWisdom?: string|null,
     *   title?: string|null,
     *   usViewersMillions?: float|null,
     *   viewerRating?: float|null,
     *   writer?: string|null,
     * }|EpisodeUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Episode>
     *
     * @throws APIException
     */
    public function update(
        string $episodeID,
        array|EpisodeUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EpisodeUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['episodes/%1$s', $episodeID],
            body: (object) $parsed,
            options: $options,
            convert: Episode::class,
        );
    }

    /**
     * @api
     *
     * Get a paginated list of all Ted Lasso episodes with optional filtering by season.
     *
     * @param array{
     *   characterFocus?: string|null, limit?: int, season?: int|null, skip?: int
     * }|EpisodeListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<Episode>>
     *
     * @throws APIException
     */
    public function list(
        array|EpisodeListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EpisodeListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'episodes',
            query: Util::array_transform_keys(
                $parsed,
                ['characterFocus' => 'character_focus']
            ),
            options: $options,
            convert: Episode::class,
            page: SkipLimitPage::class,
        );
    }

    /**
     * @api
     *
     * Remove an episode from the database.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $episodeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['episodes/%1$s', $episodeID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get Ted's wisdom and memorable moments from a specific episode.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<array<string,mixed>>
     *
     * @throws APIException
     */
    public function getWisdom(
        string $episodeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['episodes/%1$s/wisdom', $episodeID],
            options: $requestOptions,
            convert: new MapOf('mixed'),
        );
    }
}

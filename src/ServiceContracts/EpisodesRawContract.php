<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Episodes\Episode;
use Believe\Episodes\EpisodeCreateParams;
use Believe\Episodes\EpisodeListBySeasonParams;
use Believe\Episodes\EpisodeListParams;
use Believe\Episodes\EpisodeUpdateParams;
use Believe\RequestOptions;
use Believe\SkipLimitPage;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface EpisodesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|EpisodeCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Episode>
     *
     * @throws APIException
     */
    public function create(
        array|EpisodeCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|EpisodeUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|EpisodeListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<Episode>>
     *
     * @throws APIException
     */
    public function list(
        array|EpisodeListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|EpisodeListBySeasonParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<Episode>>
     *
     * @throws APIException
     */
    public function listBySeason(
        int $seasonNumber,
        array|EpisodeListBySeasonParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

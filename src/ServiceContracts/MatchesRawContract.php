<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Matches\Match_;
use Believe\Matches\MatchCreateParams;
use Believe\Matches\MatchListParams;
use Believe\Matches\MatchStreamLiveParams;
use Believe\Matches\MatchUpdateParams;
use Believe\RequestOptions;
use Believe\SkipLimitPage;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface MatchesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|MatchCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Match_>
     *
     * @throws APIException
     */
    public function create(
        array|MatchCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Match_>
     *
     * @throws APIException
     */
    public function retrieve(
        string $matchID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MatchUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Match_>
     *
     * @throws APIException
     */
    public function update(
        string $matchID,
        array|MatchUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MatchListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<Match_>>
     *
     * @throws APIException
     */
    public function list(
        array|MatchListParams $params,
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
        string $matchID,
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
    public function getLesson(
        string $matchID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<array<string,mixed>>>
     *
     * @throws APIException
     */
    public function getTurningPoints(
        string $matchID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MatchStreamLiveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function streamLive(
        array|MatchStreamLiveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

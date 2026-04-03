<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\SkipLimitPage;
use Believe\RequestOptions;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Matches\MatchCreateParams;
use Believe\Matches\Match_;
use Believe\Matches\MatchUpdateParams;
use Believe\Matches\MatchListParams;
use Believe\Matches\MatchStreamLiveParams;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface MatchesRawContract{

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
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
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
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $matchID
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
      null|RequestOptions|array $requestOptions = null,
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
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
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
    ): BaseResponse;

    /**
  * @api
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
    ): BaseResponse;

    /**
  * @api
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
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

}
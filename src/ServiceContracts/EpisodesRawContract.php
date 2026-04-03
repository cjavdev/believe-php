<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\SkipLimitPage;
use Believe\RequestOptions;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Episodes\EpisodeCreateParams;
use Believe\Episodes\Episode;
use Believe\Episodes\EpisodeUpdateParams;
use Believe\Episodes\EpisodeListParams;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface EpisodesRawContract{

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
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $episodeID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Episode>
  *
  * @throws APIException
 */
    public function retrieve(
      string $episodeID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $episodeID
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
      null|RequestOptions|array $requestOptions = null,
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
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $episodeID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
    public function delete(
      string $episodeID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $episodeID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<array<string,mixed>>
  *
  * @throws APIException
 */
    public function getWisdom(
      string $episodeID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

}
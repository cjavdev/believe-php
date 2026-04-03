<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\SkipLimitPage;
use Believe\RequestOptions;
use Believe\Characters\CharacterCreateParams;
use Believe\Characters\Character;
use Believe\Characters\CharacterUpdateParams;
use Believe\Characters\CharacterListParams;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface CharactersRawContract{

    /**
  * @api
  *
  * @param array<string,mixed>|CharacterCreateParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Character>
  *
  * @throws APIException
 */
    public function create(
      array|CharacterCreateParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $characterID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Character>
  *
  * @throws APIException
 */
    public function retrieve(
      string $characterID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $characterID
  * @param array<string,mixed>|CharacterUpdateParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Character>
  *
  * @throws APIException
 */
    public function update(
      string $characterID,
      array|CharacterUpdateParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param array<string,mixed>|CharacterListParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<SkipLimitPage<Character>>
  *
  * @throws APIException
 */
    public function list(
      array|CharacterListParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $characterID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
    public function delete(
      string $characterID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $characterID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<list<string>>
  *
  * @throws APIException
 */
    public function getQuotes(
      string $characterID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

}
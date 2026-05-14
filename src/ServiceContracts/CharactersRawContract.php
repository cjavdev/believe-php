<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Characters\Character;
use Believe\Characters\CharacterCreateParams;
use Believe\Characters\CharacterListParams;
use Believe\Characters\CharacterUpdateParams;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\SkipLimitPage;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface CharactersRawContract
{
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
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Character>
     *
     * @throws APIException
     */
    public function retrieve(
        string $characterID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
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
        RequestOptions|array|null $requestOptions = null,
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
        string $characterID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<string>>
     *
     * @throws APIException
     */
    public function getQuotes(
        string $characterID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}

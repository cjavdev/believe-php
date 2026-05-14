<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Quotes\Quote;
use Believe\Quotes\QuoteCreateParams;
use Believe\Quotes\QuoteGetRandomParams;
use Believe\Quotes\QuoteListByCharacterParams;
use Believe\Quotes\QuoteListByThemeParams;
use Believe\Quotes\QuoteListParams;
use Believe\Quotes\QuoteTheme;
use Believe\Quotes\QuoteUpdateParams;
use Believe\RequestOptions;
use Believe\SkipLimitPage;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface QuotesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|QuoteCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Quote>
     *
     * @throws APIException
     */
    public function create(
        array|QuoteCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Quote>
     *
     * @throws APIException
     */
    public function retrieve(
        string $quoteID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|QuoteUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Quote>
     *
     * @throws APIException
     */
    public function update(
        string $quoteID,
        array|QuoteUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|QuoteListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<Quote>>
     *
     * @throws APIException
     */
    public function list(
        array|QuoteListParams $params,
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
        string $quoteID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|QuoteGetRandomParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Quote>
     *
     * @throws APIException
     */
    public function getRandom(
        array|QuoteGetRandomParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|QuoteListByCharacterParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<Quote>>
     *
     * @throws APIException
     */
    public function listByCharacter(
        string $characterID,
        array|QuoteListByCharacterParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param QuoteTheme|string $theme themes that quotes can be categorized under
     * @param array<string,mixed>|QuoteListByThemeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<Quote>>
     *
     * @throws APIException
     */
    public function listByTheme(
        QuoteTheme|string $theme,
        array|QuoteListByThemeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

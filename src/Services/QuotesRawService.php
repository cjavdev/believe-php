<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\Quotes\Quote;
use Believe\Quotes\QuoteCreateParams;
use Believe\Quotes\QuoteGetRandomParams;
use Believe\Quotes\QuoteListByCharacterParams;
use Believe\Quotes\QuoteListByThemeParams;
use Believe\Quotes\QuoteListParams;
use Believe\Quotes\QuoteMoment;
use Believe\Quotes\QuoteTheme;
use Believe\Quotes\QuoteUpdateParams;
use Believe\RequestOptions;
use Believe\ServiceContracts\QuotesRawContract;
use Believe\SkipLimitPage;

/**
 * Memorable quotes from the show.
 *
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class QuotesRawService implements QuotesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Add a new memorable quote to the collection.
     *
     * @param array{
     *   characterID: string,
     *   context: string,
     *   momentType: value-of<QuoteMoment>,
     *   text: string,
     *   theme: value-of<QuoteTheme>,
     *   episodeID?: string|null,
     *   isFunny?: bool,
     *   isInspirational?: bool,
     *   popularityScore?: float|null,
     *   secondaryThemes?: list<QuoteTheme|value-of<QuoteTheme>>,
     *   timesShared?: int|null,
     * }|QuoteCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Quote>
     *
     * @throws APIException
     */
    public function create(
        array|QuoteCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = QuoteCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'quotes',
            body: (object) $parsed,
            options: $options,
            convert: Quote::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a specific quote by its ID.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['quotes/%1$s', $quoteID],
            options: $requestOptions,
            convert: Quote::class,
        );
    }

    /**
     * @api
     *
     * Update specific fields of an existing quote.
     *
     * @param array{
     *   characterID?: string|null,
     *   context?: string|null,
     *   episodeID?: string|null,
     *   isFunny?: bool|null,
     *   isInspirational?: bool|null,
     *   momentType?: value-of<QuoteMoment>,
     *   popularityScore?: float|null,
     *   secondaryThemes?: list<QuoteTheme|value-of<QuoteTheme>>|null,
     *   text?: string|null,
     *   theme?: value-of<QuoteTheme>,
     *   timesShared?: int|null,
     * }|QuoteUpdateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = QuoteUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['quotes/%1$s', $quoteID],
            body: (object) $parsed,
            options: $options,
            convert: Quote::class,
        );
    }

    /**
     * @api
     *
     * Get a paginated list of all memorable Ted Lasso quotes with optional filtering.
     *
     * @param array{
     *   characterID?: string|null,
     *   funny?: bool|null,
     *   inspirational?: bool|null,
     *   limit?: int,
     *   momentType?: value-of<QuoteMoment>,
     *   skip?: int,
     *   theme?: value-of<QuoteTheme>,
     * }|QuoteListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<Quote>>
     *
     * @throws APIException
     */
    public function list(
        array|QuoteListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = QuoteListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'quotes',
            query: Util::array_transform_keys(
                $parsed,
                ['characterID' => 'character_id', 'momentType' => 'moment_type'],
            ),
            options: $options,
            convert: Quote::class,
            page: SkipLimitPage::class,
        );
    }

    /**
     * @api
     *
     * Remove a quote from the collection.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['quotes/%1$s', $quoteID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get a random Ted Lasso quote, optionally filtered.
     *
     * @param array{
     *   characterID?: string|null,
     *   inspirational?: bool|null,
     *   theme?: value-of<QuoteTheme>,
     * }|QuoteGetRandomParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Quote>
     *
     * @throws APIException
     */
    public function getRandom(
        array|QuoteGetRandomParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = QuoteGetRandomParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'quotes/random',
            query: Util::array_transform_keys(
                $parsed,
                ['characterID' => 'character_id']
            ),
            options: $options,
            convert: Quote::class,
        );
    }

    /**
     * @api
     *
     * Get a paginated list of quotes from a specific character.
     *
     * @param array{limit?: int, skip?: int}|QuoteListByCharacterParams $params
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
    ): BaseResponse {
        [$parsed, $options] = QuoteListByCharacterParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['quotes/characters/%1$s', $characterID],
            query: $parsed,
            options: $options,
            convert: Quote::class,
            page: SkipLimitPage::class,
        );
    }

    /**
     * @api
     *
     * Get a paginated list of quotes related to a specific theme.
     *
     * @param QuoteTheme|value-of<QuoteTheme> $theme themes that quotes can be categorized under
     * @param array{limit?: int, skip?: int}|QuoteListByThemeParams $params
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
    ): BaseResponse {
        [$parsed, $options] = QuoteListByThemeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['quotes/themes/%1$s', $theme],
            query: $parsed,
            options: $options,
            convert: Quote::class,
            page: SkipLimitPage::class,
        );
    }
}

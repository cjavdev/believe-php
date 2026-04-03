<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Quotes\QuoteCreateParams;
use Believe\Quotes\Quote;
use Believe\Quotes\QuoteUpdateParams;
use Believe\Quotes\QuoteListParams;
use Believe\Quotes\QuoteGetRandomParams;
use Believe\Quotes\QuoteListByCharacterParams;
use Believe\Quotes\QuoteTheme;
use Believe\Quotes\QuoteListByThemeParams;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface QuotesRawContract{

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
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $quoteID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<Quote>
  *
  * @throws APIException
 */
    public function retrieve(
      string $quoteID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $quoteID
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
      null|RequestOptions|array $requestOptions = null,
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
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $quoteID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
    public function delete(
      string $quoteID, null|RequestOptions|array $requestOptions = null
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
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $characterID
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
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param QuoteTheme|string $theme Themes that quotes can be categorized under.
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
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

}
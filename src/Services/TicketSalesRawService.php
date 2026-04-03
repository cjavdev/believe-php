<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Client;
use Believe\Core\Util;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\TicketSalesRawContract;
use Believe\TicketSales\PurchaseMethod;
use Believe\TicketSales\TicketSaleCreateParams;
use Believe\TicketSales\TicketSale;
use Believe\TicketSales\TicketSaleUpdateParams;
use Believe\TicketSales\TicketSaleListParams;

/**
  * Ticket sales with 300 records for practicing pagination, filtering, and financial data
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class TicketSalesRawService implements TicketSalesRawContract
{
  /**
  * @api
  *
  * Record a new ticket sale.
  *
  * @param array{
  *   buyerName: string,
  *   currency: string,
  *   discount: string,
  *   matchID: string,
  *   purchaseMethod: PurchaseMethod|value-of<PurchaseMethod>,
  *   quantity: int,
  *   subtotal: string,
  *   tax: string,
  *   total: string,
  *   unitPrice: string,
  *   buyerEmail?: string|null,
  *   couponCode?: string|null,
  * }|TicketSaleCreateParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<TicketSale>
  *
  * @throws APIException
 */
  public function create(
    array|TicketSaleCreateParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = TicketSaleCreateParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'post',
      path: 'ticket-sales',
      body: (object) $parsed,
      options: $options,
      convert: TicketSale::class,
    );
  }

  /**
  * @api
  *
  * Retrieve detailed information about a specific ticket sale.
  *
  * @param string $ticketSaleID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<TicketSale>
  *
  * @throws APIException
 */
  public function retrieve(
    string $ticketSaleID, null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: ['ticket-sales/%1$s', $ticketSaleID],
      options: $requestOptions,
      convert: TicketSale::class,
    );
  }

  /**
  * @api
  *
  * Update specific fields of an existing ticket sale.
  *
  * @param string $ticketSaleID
  * @param array{
  *   buyerEmail?: string|null,
  *   buyerName?: string|null,
  *   couponCode?: string|null,
  *   currency?: string|null,
  *   discount?: string|null,
  *   matchID?: string|null,
  *   purchaseMethod?: null|PurchaseMethod|value-of<PurchaseMethod>,
  *   quantity?: int|null,
  *   subtotal?: string|null,
  *   tax?: string|null,
  *   total?: string|null,
  *   unitPrice?: string|null,
  * }|TicketSaleUpdateParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<TicketSale>
  *
  * @throws APIException
 */
  public function update(
    string $ticketSaleID,
    array|TicketSaleUpdateParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = TicketSaleUpdateParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'patch',
      path: ['ticket-sales/%1$s', $ticketSaleID],
      body: (object) $parsed,
      options: $options,
      convert: TicketSale::class,
    );
  }

  /**
  * @api
  *
  * Get a paginated list of all ticket sales with optional filtering. With 300 records, this endpoint is ideal for practicing pagination.
  *
  * @param array{
  *   couponCode?: string|null,
  *   currency?: string|null,
  *   limit?: int,
  *   matchID?: string|null,
  *   purchaseMethod?: null|PurchaseMethod|value-of<PurchaseMethod>,
  *   skip?: int,
  * }|TicketSaleListParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<SkipLimitPage<TicketSale>>
  *
  * @throws APIException
 */
  public function list(
    array|TicketSaleListParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = TicketSaleListParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: 'ticket-sales',
      query: Util::array_transform_keys(
        $parsed,
        [
          'couponCode' => 'coupon_code',
          'matchID' => 'match_id',
          'purchaseMethod' => 'purchase_method',
        ],
      ),
      options: $options,
      convert: TicketSale::class,
      page: SkipLimitPage::class,
    );
  }

  /**
  * @api
  *
  * Remove a ticket sale from the database.
  *
  * @param string $ticketSaleID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
  public function delete(
    string $ticketSaleID, null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'delete',
      path: ['ticket-sales/%1$s', $ticketSaleID],
      options: $requestOptions,
      convert: null,
    );
  }

  // @phpstan-ignore-next-line
  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {}
}
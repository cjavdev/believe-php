<?php

declare(strict_types=1);

namespace Believe\Services\Client;

use Believe\Client;
use Believe\Client\TicketSales\TicketSaleCreateParams;
use Believe\Client\TicketSales\TicketSaleCreateParams\PurchaseMethod;
use Believe\Client\TicketSales\TicketSaleGetResponse;
use Believe\Client\TicketSales\TicketSaleListParams;
use Believe\Client\TicketSales\TicketSaleListResponse;
use Believe\Client\TicketSales\TicketSaleNewResponse;
use Believe\Client\TicketSales\TicketSaleUpdateParams;
use Believe\Client\TicketSales\TicketSaleUpdateResponse;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\RequestOptions;
use Believe\ServiceContracts\Client\TicketSalesRawContract;
use Believe\SkipLimitPage;

/**
 * Ticket sales with 300 records for practicing pagination, filtering, and financial data.
 *
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class TicketSalesRawService implements TicketSalesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
     * @return BaseResponse<TicketSaleNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|TicketSaleCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
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
            convert: TicketSaleNewResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve detailed information about a specific ticket sale.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TicketSaleGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $ticketSaleID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['ticket-sales/%1$s', $ticketSaleID],
            options: $requestOptions,
            convert: TicketSaleGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Update specific fields of an existing ticket sale.
     *
     * @param array{
     *   buyerEmail?: string|null,
     *   buyerName?: string|null,
     *   couponCode?: string|null,
     *   currency?: string|null,
     *   discount?: string|null,
     *   matchID?: string|null,
     *   purchaseMethod?: TicketSaleUpdateParams\PurchaseMethod|value-of<TicketSaleUpdateParams\PurchaseMethod>|null,
     *   quantity?: int|null,
     *   subtotal?: string|null,
     *   tax?: string|null,
     *   total?: string|null,
     *   unitPrice?: string|null,
     * }|TicketSaleUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TicketSaleUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $ticketSaleID,
        array|TicketSaleUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
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
            convert: TicketSaleUpdateResponse::class,
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
     *   purchaseMethod?: TicketSaleListParams\PurchaseMethod|value-of<TicketSaleListParams\PurchaseMethod>|null,
     *   skip?: int,
     * }|TicketSaleListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<TicketSaleListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|TicketSaleListParams $params,
        RequestOptions|array|null $requestOptions = null,
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
            convert: TicketSaleListResponse::class,
            page: SkipLimitPage::class,
        );
    }

    /**
     * @api
     *
     * Remove a ticket sale from the database.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $ticketSaleID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['ticket-sales/%1$s', $ticketSaleID],
            options: $requestOptions,
            convert: null,
        );
    }
}

<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\RequestOptions;
use Believe\ServiceContracts\TicketSalesContract;
use Believe\SkipLimitPage;
use Believe\TicketSales\PurchaseMethod;
use Believe\TicketSales\TicketSale;

/**
 * Ticket sales with 300 records for practicing pagination, filtering, and financial data.
 *
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class TicketSalesService implements TicketSalesContract
{
    /**
     * @api
     */
    public TicketSalesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TicketSalesRawService($client);
    }

    /**
     * @api
     *
     * Record a new ticket sale.
     *
     * @param string $buyerName Name of the ticket buyer
     * @param string $currency Currency code (GBP, USD, or EUR)
     * @param string $discount Discount amount applied from coupon
     * @param string $matchID ID of the match
     * @param PurchaseMethod|value-of<PurchaseMethod> $purchaseMethod How the ticket was purchased
     * @param int $quantity Number of tickets purchased
     * @param string $subtotal Subtotal before discount and tax (unit_price * quantity)
     * @param string $tax Tax amount (20% UK VAT on discounted subtotal)
     * @param string $total Final total (subtotal - discount + tax)
     * @param string $unitPrice Price per ticket (decimal string)
     * @param string|null $buyerEmail Email of the ticket buyer
     * @param string|null $couponCode Coupon code applied, if any
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $buyerName,
        string $currency,
        string $discount,
        string $matchID,
        PurchaseMethod|string $purchaseMethod,
        int $quantity,
        string $subtotal,
        string $tax,
        string $total,
        string $unitPrice,
        ?string $buyerEmail = null,
        ?string $couponCode = null,
        RequestOptions|array|null $requestOptions = null,
    ): TicketSale {
        $params = Util::removeNulls(
            [
                'buyerName' => $buyerName,
                'currency' => $currency,
                'discount' => $discount,
                'matchID' => $matchID,
                'purchaseMethod' => $purchaseMethod,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'unitPrice' => $unitPrice,
                'buyerEmail' => $buyerEmail,
                'couponCode' => $couponCode,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve detailed information about a specific ticket sale.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $ticketSaleID,
        RequestOptions|array|null $requestOptions = null
    ): TicketSale {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($ticketSaleID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update specific fields of an existing ticket sale.
     *
     * @param PurchaseMethod|value-of<PurchaseMethod>|null $purchaseMethod how the ticket was purchased
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $ticketSaleID,
        ?string $buyerEmail = null,
        ?string $buyerName = null,
        ?string $couponCode = null,
        ?string $currency = null,
        ?string $discount = null,
        ?string $matchID = null,
        PurchaseMethod|string|null $purchaseMethod = null,
        ?int $quantity = null,
        ?string $subtotal = null,
        ?string $tax = null,
        ?string $total = null,
        ?string $unitPrice = null,
        RequestOptions|array|null $requestOptions = null,
    ): TicketSale {
        $params = Util::removeNulls(
            [
                'buyerEmail' => $buyerEmail,
                'buyerName' => $buyerName,
                'couponCode' => $couponCode,
                'currency' => $currency,
                'discount' => $discount,
                'matchID' => $matchID,
                'purchaseMethod' => $purchaseMethod,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'unitPrice' => $unitPrice,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($ticketSaleID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a paginated list of all ticket sales with optional filtering. With 300 records, this endpoint is ideal for practicing pagination.
     *
     * @param string|null $couponCode Filter by coupon code (use 'none' for sales without coupons)
     * @param string|null $currency Filter by currency (GBP, USD, EUR)
     * @param int $limit Maximum number of items to return (max: 100)
     * @param string|null $matchID Filter by match ID
     * @param PurchaseMethod|value-of<PurchaseMethod>|null $purchaseMethod Filter by purchase method
     * @param int $skip Number of items to skip (offset)
     * @param RequestOpts|null $requestOptions
     *
     * @return SkipLimitPage<TicketSale>
     *
     * @throws APIException
     */
    public function list(
        ?string $couponCode = null,
        ?string $currency = null,
        int $limit = 20,
        ?string $matchID = null,
        PurchaseMethod|string|null $purchaseMethod = null,
        int $skip = 0,
        RequestOptions|array|null $requestOptions = null,
    ): SkipLimitPage {
        $params = Util::removeNulls(
            [
                'couponCode' => $couponCode,
                'currency' => $currency,
                'limit' => $limit,
                'matchID' => $matchID,
                'purchaseMethod' => $purchaseMethod,
                'skip' => $skip,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Remove a ticket sale from the database.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $ticketSaleID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($ticketSaleID, requestOptions: $requestOptions);

        return $response->parse();
    }
}

<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Core\Exceptions\APIException;
use Believe\TicketSales\PurchaseMethod;
use Believe\TicketSales\TicketSale;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface TicketSalesContract{

    /**
  * @api
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
  * @return TicketSale
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
      null|RequestOptions|array $requestOptions = null,
    ): TicketSale;

    /**
  * @api
  *
  * @param string $ticketSaleID
  * @param RequestOpts|null $requestOptions
  *
  * @return TicketSale
  *
  * @throws APIException
 */
    public function retrieve(
      string $ticketSaleID, null|RequestOptions|array $requestOptions = null
    ): TicketSale;

    /**
  * @api
  *
  * @param string $ticketSaleID
  * @param string|null $buyerEmail
  * @param string|null $buyerName
  * @param string|null $couponCode
  * @param string|null $currency
  * @param string|null $discount
  * @param string|null $matchID
  * @param null|PurchaseMethod|value-of<PurchaseMethod> $purchaseMethod How the ticket was purchased.
  * @param int|null $quantity
  * @param string|null $subtotal
  * @param string|null $tax
  * @param string|null $total
  * @param string|null $unitPrice
  * @param RequestOpts|null $requestOptions
  *
  * @return TicketSale
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
      null|PurchaseMethod|string $purchaseMethod = null,
      ?int $quantity = null,
      ?string $subtotal = null,
      ?string $tax = null,
      ?string $total = null,
      ?string $unitPrice = null,
      null|RequestOptions|array $requestOptions = null,
    ): TicketSale;

    /**
  * @api
  *
  * @param string|null $couponCode Filter by coupon code (use 'none' for sales without coupons)
  * @param string|null $currency Filter by currency (GBP, USD, EUR)
  * @param int $limit Maximum number of items to return (max: 100)
  * @param string|null $matchID Filter by match ID
  * @param null|PurchaseMethod|value-of<PurchaseMethod> $purchaseMethod Filter by purchase method
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
      null|PurchaseMethod|string $purchaseMethod = null,
      int $skip = 0,
      null|RequestOptions|array $requestOptions = null,
    ): SkipLimitPage;

    /**
  * @api
  *
  * @param string $ticketSaleID
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
    public function delete(
      string $ticketSaleID, null|RequestOptions|array $requestOptions = null
    ): mixed;

}
<?php

declare(strict_types=1);

namespace Believe\Client\TicketSales;

use Believe\Client\TicketSales\TicketSaleListResponse\PurchaseMethod;
use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
 * Full ticket sale model with ID.
 *
 * @phpstan-type TicketSaleListResponseShape = array{
 *   id: string,
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
 * }
 */
final class TicketSaleListResponse implements BaseModel
{
    /** @use SdkModel<TicketSaleListResponseShape> */
    use SdkModel;

    /**
     * Unique identifier.
     */
    #[Required]
    public string $id;

    /**
     * Name of the ticket buyer.
     */
    #[Required('buyer_name')]
    public string $buyerName;

    /**
     * Currency code (GBP, USD, or EUR).
     */
    #[Required]
    public string $currency;

    /**
     * Discount amount applied from coupon.
     */
    #[Required]
    public string $discount;

    /**
     * ID of the match.
     */
    #[Required('match_id')]
    public string $matchID;

    /**
     * How the ticket was purchased.
     *
     * @var value-of<PurchaseMethod> $purchaseMethod
     */
    #[Required('purchase_method', enum: PurchaseMethod::class)]
    public string $purchaseMethod;

    /**
     * Number of tickets purchased.
     */
    #[Required]
    public int $quantity;

    /**
     * Subtotal before discount and tax (unit_price * quantity).
     */
    #[Required]
    public string $subtotal;

    /**
     * Tax amount (20% UK VAT on discounted subtotal).
     */
    #[Required]
    public string $tax;

    /**
     * Final total (subtotal - discount + tax).
     */
    #[Required]
    public string $total;

    /**
     * Price per ticket (decimal string).
     */
    #[Required('unit_price')]
    public string $unitPrice;

    /**
     * Email of the ticket buyer.
     */
    #[Optional('buyer_email', nullable: true)]
    public ?string $buyerEmail;

    /**
     * Coupon code applied, if any.
     */
    #[Optional('coupon_code', nullable: true)]
    public ?string $couponCode;

    /**
     * `new TicketSaleListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TicketSaleListResponse::with(
     *   id: ...,
     *   buyerName: ...,
     *   currency: ...,
     *   discount: ...,
     *   matchID: ...,
     *   purchaseMethod: ...,
     *   quantity: ...,
     *   subtotal: ...,
     *   tax: ...,
     *   total: ...,
     *   unitPrice: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TicketSaleListResponse)
     *   ->withID(...)
     *   ->withBuyerName(...)
     *   ->withCurrency(...)
     *   ->withDiscount(...)
     *   ->withMatchID(...)
     *   ->withPurchaseMethod(...)
     *   ->withQuantity(...)
     *   ->withSubtotal(...)
     *   ->withTax(...)
     *   ->withTotal(...)
     *   ->withUnitPrice(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param PurchaseMethod|value-of<PurchaseMethod> $purchaseMethod
     */
    public static function with(
        string $id,
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
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['buyerName'] = $buyerName;
        $self['currency'] = $currency;
        $self['discount'] = $discount;
        $self['matchID'] = $matchID;
        $self['purchaseMethod'] = $purchaseMethod;
        $self['quantity'] = $quantity;
        $self['subtotal'] = $subtotal;
        $self['tax'] = $tax;
        $self['total'] = $total;
        $self['unitPrice'] = $unitPrice;

        null !== $buyerEmail && $self['buyerEmail'] = $buyerEmail;
        null !== $couponCode && $self['couponCode'] = $couponCode;

        return $self;
    }

    /**
     * Unique identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Name of the ticket buyer.
     */
    public function withBuyerName(string $buyerName): self
    {
        $self = clone $this;
        $self['buyerName'] = $buyerName;

        return $self;
    }

    /**
     * Currency code (GBP, USD, or EUR).
     */
    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Discount amount applied from coupon.
     */
    public function withDiscount(string $discount): self
    {
        $self = clone $this;
        $self['discount'] = $discount;

        return $self;
    }

    /**
     * ID of the match.
     */
    public function withMatchID(string $matchID): self
    {
        $self = clone $this;
        $self['matchID'] = $matchID;

        return $self;
    }

    /**
     * How the ticket was purchased.
     *
     * @param PurchaseMethod|value-of<PurchaseMethod> $purchaseMethod
     */
    public function withPurchaseMethod(
        PurchaseMethod|string $purchaseMethod
    ): self {
        $self = clone $this;
        $self['purchaseMethod'] = $purchaseMethod;

        return $self;
    }

    /**
     * Number of tickets purchased.
     */
    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * Subtotal before discount and tax (unit_price * quantity).
     */
    public function withSubtotal(string $subtotal): self
    {
        $self = clone $this;
        $self['subtotal'] = $subtotal;

        return $self;
    }

    /**
     * Tax amount (20% UK VAT on discounted subtotal).
     */
    public function withTax(string $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }

    /**
     * Final total (subtotal - discount + tax).
     */
    public function withTotal(string $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }

    /**
     * Price per ticket (decimal string).
     */
    public function withUnitPrice(string $unitPrice): self
    {
        $self = clone $this;
        $self['unitPrice'] = $unitPrice;

        return $self;
    }

    /**
     * Email of the ticket buyer.
     */
    public function withBuyerEmail(?string $buyerEmail): self
    {
        $self = clone $this;
        $self['buyerEmail'] = $buyerEmail;

        return $self;
    }

    /**
     * Coupon code applied, if any.
     */
    public function withCouponCode(?string $couponCode): self
    {
        $self = clone $this;
        $self['couponCode'] = $couponCode;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Believe\TicketSales;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Update specific fields of an existing ticket sale.
 *
 * @see Believe\Services\TicketSalesService::update()
 *
 * @phpstan-type TicketSaleUpdateParamsShape = array{
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
 * }
 */
final class TicketSaleUpdateParams implements BaseModel
{
    /** @use SdkModel<TicketSaleUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional('buyer_email', nullable: true)]
    public ?string $buyerEmail;

    #[Optional('buyer_name', nullable: true)]
    public ?string $buyerName;

    #[Optional('coupon_code', nullable: true)]
    public ?string $couponCode;

    #[Optional(nullable: true)]
    public ?string $currency;

    #[Optional(nullable: true)]
    public ?string $discount;

    #[Optional('match_id', nullable: true)]
    public ?string $matchID;

    /**
     * How the ticket was purchased.
     *
     * @var value-of<PurchaseMethod>|null $purchaseMethod
     */
    #[Optional('purchase_method', enum: PurchaseMethod::class, nullable: true)]
    public ?string $purchaseMethod;

    #[Optional(nullable: true)]
    public ?int $quantity;

    #[Optional(nullable: true)]
    public ?string $subtotal;

    #[Optional(nullable: true)]
    public ?string $tax;

    #[Optional(nullable: true)]
    public ?string $total;

    #[Optional('unit_price', nullable: true)]
    public ?string $unitPrice;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param PurchaseMethod|value-of<PurchaseMethod>|null $purchaseMethod
     */
    public static function with(
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
    ): self {
        $self = new self;

        null !== $buyerEmail && $self['buyerEmail'] = $buyerEmail;
        null !== $buyerName && $self['buyerName'] = $buyerName;
        null !== $couponCode && $self['couponCode'] = $couponCode;
        null !== $currency && $self['currency'] = $currency;
        null !== $discount && $self['discount'] = $discount;
        null !== $matchID && $self['matchID'] = $matchID;
        null !== $purchaseMethod && $self['purchaseMethod'] = $purchaseMethod;
        null !== $quantity && $self['quantity'] = $quantity;
        null !== $subtotal && $self['subtotal'] = $subtotal;
        null !== $tax && $self['tax'] = $tax;
        null !== $total && $self['total'] = $total;
        null !== $unitPrice && $self['unitPrice'] = $unitPrice;

        return $self;
    }

    public function withBuyerEmail(?string $buyerEmail): self
    {
        $self = clone $this;
        $self['buyerEmail'] = $buyerEmail;

        return $self;
    }

    public function withBuyerName(?string $buyerName): self
    {
        $self = clone $this;
        $self['buyerName'] = $buyerName;

        return $self;
    }

    public function withCouponCode(?string $couponCode): self
    {
        $self = clone $this;
        $self['couponCode'] = $couponCode;

        return $self;
    }

    public function withCurrency(?string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    public function withDiscount(?string $discount): self
    {
        $self = clone $this;
        $self['discount'] = $discount;

        return $self;
    }

    public function withMatchID(?string $matchID): self
    {
        $self = clone $this;
        $self['matchID'] = $matchID;

        return $self;
    }

    /**
     * How the ticket was purchased.
     *
     * @param PurchaseMethod|value-of<PurchaseMethod>|null $purchaseMethod
     */
    public function withPurchaseMethod(
        PurchaseMethod|string|null $purchaseMethod
    ): self {
        $self = clone $this;
        $self['purchaseMethod'] = $purchaseMethod;

        return $self;
    }

    public function withQuantity(?int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    public function withSubtotal(?string $subtotal): self
    {
        $self = clone $this;
        $self['subtotal'] = $subtotal;

        return $self;
    }

    public function withTax(?string $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }

    public function withTotal(?string $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }

    public function withUnitPrice(?string $unitPrice): self
    {
        $self = clone $this;
        $self['unitPrice'] = $unitPrice;

        return $self;
    }
}

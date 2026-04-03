<?php

declare(strict_types=1);

namespace Believe\TicketSales;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Update specific fields of an existing ticket sale.
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
  *
 */
final class TicketSaleUpdateParams implements BaseModel
{
  /** @use SdkModel<TicketSaleUpdateParamsShape> */
  use SdkModel;
  use SdkParams;

  /** @var string|null $buyerEmail */
  #[Optional('buyer_email', nullable: true)]
  public ?string $buyerEmail;

  /** @var string|null $buyerName */
  #[Optional('buyer_name', nullable: true)]
  public ?string $buyerName;

  /** @var string|null $couponCode */
  #[Optional('coupon_code', nullable: true)]
  public ?string $couponCode;

  /** @var string|null $currency */
  #[Optional(nullable: true)]
  public ?string $currency;

  /** @var string|null $discount */
  #[Optional(nullable: true)]
  public ?string $discount;

  /** @var string|null $matchID */
  #[Optional('match_id', nullable: true)]
  public ?string $matchID;

  /**
  * How the ticket was purchased.
  *
  * @var value-of<PurchaseMethod>|null $purchaseMethod
 */
  #[Optional('purchase_method', enum: PurchaseMethod::class, nullable: true)]
  public ?string $purchaseMethod;

  /** @var int|null $quantity */
  #[Optional(nullable: true)]
  public ?int $quantity;

  /** @var string|null $subtotal */
  #[Optional(nullable: true)]
  public ?string $subtotal;

  /** @var string|null $tax */
  #[Optional(nullable: true)]
  public ?string $tax;

  /** @var string|null $total */
  #[Optional(nullable: true)]
  public ?string $total;

  /** @var string|null $unitPrice */
  #[Optional('unit_price', nullable: true)]
  public ?string $unitPrice;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string|null $buyerEmail
  * @param string|null $buyerName
  * @param string|null $couponCode
  * @param string|null $currency
  * @param string|null $discount
  * @param string|null $matchID
  * @param null|PurchaseMethod|value-of<PurchaseMethod> $purchaseMethod
  * @param int|null $quantity
  * @param string|null $subtotal
  * @param string|null $tax
  * @param string|null $total
  * @param string|null $unitPrice
  *
  * @return self
 */
  public static function with(
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

  /**
  * @param string|null $buyerEmail
  *
  * @return self
 */
  public function withBuyerEmail(?string $buyerEmail): self {
    $self = clone $this;
    $self['buyerEmail'] = $buyerEmail;
    return $self;
  }

  /**
  * @param string|null $buyerName
  *
  * @return self
 */
  public function withBuyerName(?string $buyerName): self {
    $self = clone $this;
    $self['buyerName'] = $buyerName;
    return $self;
  }

  /**
  * @param string|null $couponCode
  *
  * @return self
 */
  public function withCouponCode(?string $couponCode): self {
    $self = clone $this;
    $self['couponCode'] = $couponCode;
    return $self;
  }

  /**
  * @param string|null $currency
  *
  * @return self
 */
  public function withCurrency(?string $currency): self {
    $self = clone $this;
    $self['currency'] = $currency;
    return $self;
  }

  /**
  * @param string|null $discount
  *
  * @return self
 */
  public function withDiscount(?string $discount): self {
    $self = clone $this;
    $self['discount'] = $discount;
    return $self;
  }

  /**
  * @param string|null $matchID
  *
  * @return self
 */
  public function withMatchID(?string $matchID): self {
    $self = clone $this;
    $self['matchID'] = $matchID;
    return $self;
  }

  /**
  * How the ticket was purchased.
  *
  * @param null|PurchaseMethod|value-of<PurchaseMethod> $purchaseMethod
  *
  * @return self
 */
  public function withPurchaseMethod(
    null|PurchaseMethod|string $purchaseMethod
  ): self {
    $self = clone $this;
    $self['purchaseMethod'] = $purchaseMethod;
    return $self;
  }

  /**
  * @param int|null $quantity
  *
  * @return self
 */
  public function withQuantity(?int $quantity): self {
    $self = clone $this;
    $self['quantity'] = $quantity;
    return $self;
  }

  /**
  * @param string|null $subtotal
  *
  * @return self
 */
  public function withSubtotal(?string $subtotal): self {
    $self = clone $this;
    $self['subtotal'] = $subtotal;
    return $self;
  }

  /**
  * @param string|null $tax
  *
  * @return self
 */
  public function withTax(?string $tax): self {
    $self = clone $this;
    $self['tax'] = $tax;
    return $self;
  }

  /**
  * @param string|null $total
  *
  * @return self
 */
  public function withTotal(?string $total): self {
    $self = clone $this;
    $self['total'] = $total;
    return $self;
  }

  /**
  * @param string|null $unitPrice
  *
  * @return self
 */
  public function withUnitPrice(?string $unitPrice): self {
    $self = clone $this;
    $self['unitPrice'] = $unitPrice;
    return $self;
  }
}
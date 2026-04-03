<?php

declare(strict_types=1);

namespace Believe\TicketSales;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Get a paginated list of all ticket sales with optional filtering. With 300 records, this endpoint is ideal for practicing pagination.
  * @see Believe\Services\TicketSalesService::list()
  *
  * @phpstan-type TicketSaleListParamsShape = array{
  *   couponCode?: string|null,
  *   currency?: string|null,
  *   limit?: int|null,
  *   matchID?: string|null,
  *   purchaseMethod?: null|PurchaseMethod|value-of<PurchaseMethod>,
  *   skip?: int|null,
  * }
  *
 */
final class TicketSaleListParams implements BaseModel
{
  /** @use SdkModel<TicketSaleListParamsShape> */
  use SdkModel;
  use SdkParams;

  /**
  * Filter by coupon code (use 'none' for sales without coupons)
  *
  * @var string|null $couponCode
 */
  #[Optional(nullable: true)]
  public ?string $couponCode;

  /**
  * Filter by currency (GBP, USD, EUR)
  *
  * @var string|null $currency
 */
  #[Optional(nullable: true)]
  public ?string $currency;

  /**
  * Maximum number of items to return (max: 100)
  *
  * @var int|null $limit
 */
  #[Optional]
  public ?int $limit;

  /**
  * Filter by match ID
  *
  * @var string|null $matchID
 */
  #[Optional(nullable: true)]
  public ?string $matchID;

  /**
  * Filter by purchase method
  *
  * @var value-of<PurchaseMethod>|null $purchaseMethod
 */
  #[Optional(enum: PurchaseMethod::class, nullable: true)]
  public ?string $purchaseMethod;

  /**
  * Number of items to skip (offset)
  *
  * @var int|null $skip
 */
  #[Optional]
  public ?int $skip;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string|null $couponCode
  * @param string|null $currency
  * @param int|null $limit
  * @param string|null $matchID
  * @param null|PurchaseMethod|value-of<PurchaseMethod> $purchaseMethod
  * @param int|null $skip
  *
  * @return self
 */
  public static function with(
    ?string $couponCode = null,
    ?string $currency = null,
    int $limit = null,
    ?string $matchID = null,
    null|PurchaseMethod|string $purchaseMethod = null,
    int $skip = null,
  ): self {
    $self = new self;

    null !== $couponCode && $self['couponCode'] = $couponCode;
    null !== $currency && $self['currency'] = $currency;
    null !== $limit && $self['limit'] = $limit;
    null !== $matchID && $self['matchID'] = $matchID;
    null !== $purchaseMethod && $self['purchaseMethod'] = $purchaseMethod;
    null !== $skip && $self['skip'] = $skip;

    return $self;
  }

  /**
  * Filter by coupon code (use 'none' for sales without coupons)
  *
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
  * Filter by currency (GBP, USD, EUR)
  *
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
  * Maximum number of items to return (max: 100)
  *
  * @param int $limit
  *
  * @return self
 */
  public function withLimit(int $limit): self {
    $self = clone $this;
    $self['limit'] = $limit;
    return $self;
  }

  /**
  * Filter by match ID
  *
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
  * Filter by purchase method
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
  * Number of items to skip (offset)
  *
  * @param int $skip
  *
  * @return self
 */
  public function withSkip(int $skip): self {
    $self = clone $this;
    $self['skip'] = $skip;
    return $self;
  }
}
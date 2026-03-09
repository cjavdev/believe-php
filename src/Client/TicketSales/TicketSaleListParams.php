<?php

declare(strict_types=1);

namespace Believe\Client\TicketSales;

use Believe\Client\TicketSales\TicketSaleListParams\PurchaseMethod;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Get a paginated list of all ticket sales with optional filtering. With 300 records, this endpoint is ideal for practicing pagination.
 *
 * @see Believe\Services\Client\TicketSalesService::list()
 *
 * @phpstan-type TicketSaleListParamsShape = array{
 *   couponCode?: string|null,
 *   currency?: string|null,
 *   limit?: int|null,
 *   matchID?: string|null,
 *   purchaseMethod?: null|PurchaseMethod|value-of<PurchaseMethod>,
 *   skip?: int|null,
 * }
 */
final class TicketSaleListParams implements BaseModel
{
    /** @use SdkModel<TicketSaleListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by coupon code (use 'none' for sales without coupons).
     */
    #[Optional(nullable: true)]
    public ?string $couponCode;

    /**
     * Filter by currency (GBP, USD, EUR).
     */
    #[Optional(nullable: true)]
    public ?string $currency;

    /**
     * Maximum number of items to return (max: 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter by match ID.
     */
    #[Optional(nullable: true)]
    public ?string $matchID;

    /**
     * Filter by purchase method.
     *
     * @var value-of<PurchaseMethod>|null $purchaseMethod
     */
    #[Optional(enum: PurchaseMethod::class, nullable: true)]
    public ?string $purchaseMethod;

    /**
     * Number of items to skip (offset).
     */
    #[Optional]
    public ?int $skip;

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
        ?string $couponCode = null,
        ?string $currency = null,
        ?int $limit = null,
        ?string $matchID = null,
        PurchaseMethod|string|null $purchaseMethod = null,
        ?int $skip = null,
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
     * Filter by coupon code (use 'none' for sales without coupons).
     */
    public function withCouponCode(?string $couponCode): self
    {
        $self = clone $this;
        $self['couponCode'] = $couponCode;

        return $self;
    }

    /**
     * Filter by currency (GBP, USD, EUR).
     */
    public function withCurrency(?string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Maximum number of items to return (max: 100).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter by match ID.
     */
    public function withMatchID(?string $matchID): self
    {
        $self = clone $this;
        $self['matchID'] = $matchID;

        return $self;
    }

    /**
     * Filter by purchase method.
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

    /**
     * Number of items to skip (offset).
     */
    public function withSkip(int $skip): self
    {
        $self = clone $this;
        $self['skip'] = $skip;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Believe\Matches\MatchUpdateParams;

use Believe\Core\Concerns\SdkUnion;
use Believe\Core\Conversion\Contracts\Converter;
use Believe\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-type TicketRevenueGbpVariants = float|string
 * @phpstan-type TicketRevenueGbpShape = TicketRevenueGbpVariants
 */
final class TicketRevenueGbp implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['float', 'string'];
    }
}

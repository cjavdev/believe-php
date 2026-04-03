<?php

declare(strict_types=1);

namespace Believe\Matches\MatchCreateParams;

use Believe\Core\Concerns\SdkUnion;
use Believe\Core\Conversion\Contracts\ConverterSource;
use Believe\Core\Conversion\Contracts\Converter;

/**
  * Total ticket revenue in GBP
  *
  * @phpstan-type TicketRevenueGbpVariants = float|string
  *
  * @phpstan-type TicketRevenueGbpShape = TicketRevenueGbpVariants
  *
 */
final class TicketRevenueGbp implements ConverterSource
{
  use SdkUnion;

  /**
  * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
 */
  static function variants(): array {
    return ['float', 'string'];
  }
}
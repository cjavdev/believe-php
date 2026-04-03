<?php

declare(strict_types=1);

namespace Believe\Teams\TeamCreateParams;

use Believe\Core\Concerns\SdkUnion;
use Believe\Core\Conversion\Contracts\ConverterSource;
use Believe\Core\Conversion\Contracts\Converter;

/**
  * Annual budget in GBP
  *
  * @phpstan-type AnnualBudgetGbpVariants = float|string
  *
  * @phpstan-type AnnualBudgetGbpShape = AnnualBudgetGbpVariants
  *
 */
final class AnnualBudgetGbp implements ConverterSource
{
  use SdkUnion;

  /**
  * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
 */
  static function variants(): array {
    return ['float', 'string'];
  }
}
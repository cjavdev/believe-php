<?php

declare(strict_types=1);

namespace Believe\Characters\CharacterUpdateParams;

use Believe\Core\Concerns\SdkUnion;
use Believe\Core\Conversion\Contracts\ConverterSource;
use Believe\Core\Conversion\Contracts\Converter;

/**
  *
  * @phpstan-type SalaryGbpVariants = float|string
  *
  * @phpstan-type SalaryGbpShape = SalaryGbpVariants
  *
 */
final class SalaryGbp implements ConverterSource
{
  use SdkUnion;

  /**
  * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
 */
  static function variants(): array {
    return ['float', 'string'];
  }
}
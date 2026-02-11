<?php

declare(strict_types=1);

namespace Believe\Characters\CharacterCreateParams;

use Believe\Core\Concerns\SdkUnion;
use Believe\Core\Conversion\Contracts\Converter;
use Believe\Core\Conversion\Contracts\ConverterSource;

/**
 * Annual salary in GBP.
 *
 * @phpstan-type SalaryGbpVariants = float|string
 * @phpstan-type SalaryGbpShape = SalaryGbpVariants
 */
final class SalaryGbp implements ConverterSource
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

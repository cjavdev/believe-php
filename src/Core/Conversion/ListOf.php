<?php

declare(strict_types=1);

namespace Believe\Core\Conversion;

use Believe\Core\Conversion\Concerns\ArrayOf;
use Believe\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class ListOf implements Converter
{
    use ArrayOf;

    // @phpstan-ignore-next-line missingType.iterableValue
    private function empty(): array|object
    {
        return [];
    }
}

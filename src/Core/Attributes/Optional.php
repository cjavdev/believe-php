<?php

declare(strict_types=1);

namespace Believe\Core\Attributes;

use Believe\Core\Conversion\Contracts\Converter;
use Believe\Core\Conversion\Contracts\ConverterSource;

/**
 * @internal
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class Optional extends Required
{
    /**
     * @param null|class-string<ConverterSource>|Converter|string $type
     * @param null|class-string<\BackedEnum>|Converter            $enum
     * @param null|class-string<ConverterSource>|Converter        $union
     * @param null|class-string<ConverterSource>|Converter|string $list
     * @param null|class-string<ConverterSource>|Converter|string $map
     */
    public function __construct(
        ?string $apiName = null,
        null|Converter|string $type = null,
        null|Converter|string $enum = null,
        null|Converter|string $union = null,
        null|Converter|string $list = null,
        null|Converter|string $map = null,
        bool $nullable = false,
    ) {
        parent::__construct(apiName: $apiName, type: $type, enum: $enum, union: $union, list: $list, map: $map, nullable: $nullable);
        $this->optional = true;
    }
}

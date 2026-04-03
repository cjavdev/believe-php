<?php

declare(strict_types=1);

namespace Believe\Core\Attributes;

use Believe\Core\Conversion\Contracts\Converter;
use Believe\Core\Conversion\Contracts\ConverterSource;
use Believe\Core\Conversion\EnumOf;
use Believe\Core\Conversion\ListOf;
use Believe\Core\Conversion\MapOf;

/**
 * @internal
 */
#[\Attribute(\Attribute::TARGET_PROPERTY)]
class Required
{
    /** @var class-string<ConverterSource>|Converter|string|null */
    public readonly Converter|string|null $type;

    /** @var array<string,Converter> */
    private static array $enumConverters = [];

    public readonly ?string $apiName;

    public bool $optional;

    public readonly bool $nullable;

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
        $type ??= $union;
        if (null !== $list) {
            $type ??= new ListOf($list);
        }
        if (null !== $map) {
            $type ??= new MapOf($map);
        }
        if (null !== $enum) {
            $type ??= $enum instanceof Converter ? $enum : self::enumConverter($enum);
        }

        $this->apiName = $apiName;
        $this->type = $type;
        $this->optional = false;
        $this->nullable = $nullable;
    }

    /** @property class-string<\BackedEnum> $enum */
    private static function enumConverter(string $enum): Converter
    {
        if (!isset(self::$enumConverters[$enum])) {
            // @phpstan-ignore-next-line argument.type
            $converter = new EnumOf(array_column($enum::cases(), column_key: 'value'));
            self::$enumConverters[$enum] = $converter;
        }

        return self::$enumConverters[$enum];
    }
}

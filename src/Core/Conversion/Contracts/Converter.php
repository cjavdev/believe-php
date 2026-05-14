<?php

declare(strict_types=1);

namespace Believe\Core\Conversion\Contracts;

use Believe\Core\Conversion\CoerceState;
use Believe\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}

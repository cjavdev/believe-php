<?php

declare(strict_types=1);

namespace Believe\Core\Conversion;

use Believe\Core\Conversion;
use Believe\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class EnumOf implements Converter
{
    private readonly string $type;

    /**
     * @param list<null|bool|float|int|string> $members
     */
    public function __construct(private readonly array $members)
    {
        $type = 'NULL';
        foreach ($this->members as $member) {
            $type = gettype($member);
        }
        $this->type = $type;
    }

    private function tally(mixed $value, CoerceState | DumpState $state): void
    {
        if (in_array($value, haystack: $this->members, strict: true)) {
            ++$state->yes;
        } elseif ($this->type === gettype($value)) {
            ++$state->maybe;
        } else {
            ++$state->no;
        }
    }

    public function coerce(mixed $value, CoerceState $state): mixed
    {
        $this->tally($value, state: $state);

        return $value;
    }

    public function dump(mixed $value, DumpState $state): mixed
    {
        $this->tally($value, state: $state);

        return Conversion::dump_unknown($value, state: $state);
    }
}

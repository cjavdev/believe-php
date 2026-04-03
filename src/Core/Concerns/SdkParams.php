<?php

declare(strict_types=1);

namespace Believe\Core\Concerns;

use Believe\Core\Conversion;
use Believe\Core\Conversion\DumpState;
use Believe\Core\Util;
use Believe\RequestOptions;

/**
 * @internal
 */
trait SdkParams
{
    /**
     * @param null|array<string, mixed>|RequestOptions $options
     *
     * @return array{array<string, mixed>, RequestOptions}
     */
    public static function parseRequest(mixed $params, null|array|RequestOptions $options): array
    {
        $converter = self::converter();
        $state = new DumpState();
        $dumped = (array) Conversion::dump($converter, value: $params, state: $state);
        // @phpstan-ignore-next-line argument.type
        $opts = RequestOptions::parse($options);

        if (!$state->canRetry) {
            $opts->maxRetries = 0;
        }

        // @phpstan-ignore-next-line return.type
        return [$dumped, $opts];
    }
}

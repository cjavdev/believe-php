<?php

namespace Believe\Core\Exceptions;

use Psr\Http\Message\RequestInterface;

class APITimeoutException extends APIConnectionException
{
    /** @var string */
    protected const DESC = 'Believe API Timeout Exception';

    public function __construct(
        RequestInterface $request,
        ?\Throwable $previous = null,
        string $message = 'Request timed out.',
    ) {
        parent::__construct(request: $request, message: $message, previous: $previous);
    }
}

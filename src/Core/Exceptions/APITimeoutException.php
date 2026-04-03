<?php

namespace Believe\Core\Exceptions;

use Psr\Http\Message\RequestInterface;

/**
  *
  *
 */
class APITimeoutException extends APIConnectionException
{
  /** @var string */
  protected const DESC = 'Believe API Timeout Exception';

  /**
  * @param RequestInterface $request
  * @param \Throwable|null $previous
  * @param string $message
 */
  function __construct(
    RequestInterface $request,
    ?\Throwable $previous = null,
    string $message = 'Request timed out.',
  ) {
    parent::__construct(request: $request, message: $message, previous: $previous);
  }
}
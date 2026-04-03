<?php

namespace Believe\Core\Exceptions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

/**
  *
  *
 */
class APIException extends BelieveException
{
  /** @var int|null $status */
  public ?int $status  = null;

  /** @var mixed $body */
  public mixed $body  = null;

  /** @var ResponseInterface|null $response */
  public ?ResponseInterface $response  = null;

  /**
  * @param RequestInterface $request
  * @param \Throwable|null $previous
  * @param string $message
 */
  function __construct(
    public RequestInterface $request,
    ?\Throwable $previous = null,
    string $message = '',
  ) {parent::__construct(message: $message, previous: $previous);}
}
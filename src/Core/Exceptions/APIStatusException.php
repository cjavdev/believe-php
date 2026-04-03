<?php

namespace Believe\Core\Exceptions;

use Believe\Core\Util;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
  *
  *
 */
class APIStatusException extends APIException
{
  /** @var string */
  protected const DESC = 'Believe API Status Error';

  /** @var int|null $status */
  public ?int $status;

  /**
  * @param RequestInterface $request
  * @param ResponseInterface $response
  * @param string $message
  *
  * @return self
 */
  public static function from(
    RequestInterface $request, ResponseInterface $response, string $message = ''
  ): self {
    $status = $response->getStatusCode();

    $cls = match (true)
    {

        $status === 400 => BadRequestException::class,
        $status === 401 => AuthenticationException::class,
        $status === 403 => PermissionDeniedException::class,
        $status === 404 => NotFoundException::class,
        $status === 409 => ConflictException::class,
        $status === 422 => UnprocessableEntityException::class,
        $status === 429 => RateLimitException::class,
        $status >= 500 => InternalServerException::class,
        default => APIStatusException::class

    };

    return new $cls(request: $request, response: $response, message: $message);
  }

  /**
  * @param RequestInterface $request
  * @param \Throwable|null $previous
  * @param ResponseInterface $response
  * @param string $message
 */
  function __construct(
    public RequestInterface $request,
    ResponseInterface $response,
    ?\Throwable $previous = null,
    string $message = '',
  ) {
    $this->response = $response;
    $this->status = $response->getStatusCode();

    $summary = Util::prettyEncodeJson(['status' => $this->status, 'body' => Util::decodeJson($response->getBody())]);

    if ('' != $message) {
        $summary .= $message . PHP_EOL . $summary;
    }

    parent::__construct(request: $request, message: $summary, previous: $previous);
  }
}
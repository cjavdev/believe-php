<?php

declare(strict_types=1);

namespace Believe;

use Believe\Core\Attributes\Required as Property;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\RequestFactoryInterface;

/**
  *
  * @phpstan-type RequestOptionShape = array{
  *   timeout?: float|null,
  *   maxRetries?: int|null,
  *   initialRetryDelay?: float|null,
  *   maxRetryDelay?: float|null,
  *   extraHeaders?: array<string,string|int|null|list<string|int>>|null,
  *   extraQueryParams?: array<string,mixed>|null,
  *   extraBodyParams?: mixed,
  *   transporter?: ClientInterface|null,
  *   uriFactory?: UriFactoryInterface|null,
  *   streamFactory?: StreamFactoryInterface|null,
  *   requestFactory?: RequestFactoryInterface|null,
  * }
  *
  * @phpstan-type RequestOpts = null|RequestOptions|RequestOptionShape
  *
 */
final class RequestOptions implements BaseModel
{
  /** @use SdkModel<RequestOptionShape> */
  use SdkModel;

  /** @var float $timeout */
  #[Property]
  public float $timeout  = 60;

  /** @var int $maxRetries */
  #[Property]
  public int $maxRetries  = 2;

  /** @var float $initialRetryDelay */
  #[Property]
  public float $initialRetryDelay  = 0.5;

  /** @var float $maxRetryDelay */
  #[Property]
  public float $maxRetryDelay  = 8.0;

  /** @var array<string,string|int|null|list<string|int>>|null $extraHeaders */
  #[Optional]
  public ?array $extraHeaders;

  /** @var array<string,mixed>|null $extraQueryParams */
  #[Optional]
  public ?array $extraQueryParams;

  /** @var mixed $extraBodyParams */
  #[Optional]
  public mixed $extraBodyParams;

  /** @var ClientInterface|null $transporter */
  #[Optional]
  public ?ClientInterface $transporter;

  /** @var UriFactoryInterface|null $uriFactory */
  #[Optional]
  public ?UriFactoryInterface $uriFactory;

  /** @var StreamFactoryInterface|null $streamFactory */
  #[Optional]
  public ?StreamFactoryInterface $streamFactory;

  /** @var RequestFactoryInterface|null $requestFactory */
  #[Optional]
  public ?RequestFactoryInterface $requestFactory;

  /**
  * @param RequestOpts|null $options
  *
  * @return self
 */
  public static function parse(null|RequestOptions|array ...$options): self {
    $parsed = array_map(static fn ($o) => ($o instanceof self ? $o->toProperties() : $o ?? []), array: $options);

    // @phpstan-ignore-next-line argument.type
    return self::with(...array_merge(...$parsed));
  }

  /**
  * @param float|null $timeout
  * @param int|null $maxRetries
  * @param float|null $initialRetryDelay
  * @param float|null $maxRetryDelay
  * @param array<string,string|int|null|list<string|int>>|null $extraHeaders
  * @param array<string,mixed>|null $extraQueryParams
  * @param mixed $extraBodyParams
  * @param ClientInterface|null $transporter
  * @param UriFactoryInterface|null $uriFactory
  * @param StreamFactoryInterface|null $streamFactory
  * @param RequestFactoryInterface|null $requestFactory
  *
  * @return self
 */
  public static function with(
    ?float $timeout = null,
    ?int $maxRetries = null,
    ?float $initialRetryDelay = null,
    ?float $maxRetryDelay = null,
    ?array $extraHeaders = null,
    ?array $extraQueryParams = null,
    mixed $extraBodyParams = null,
    ?ClientInterface $transporter = null,
    ?UriFactoryInterface $uriFactory = null,
    ?StreamFactoryInterface $streamFactory = null,
    ?RequestFactoryInterface $requestFactory = null,
  ): self {
    $self = new self;

    null !== $timeout && $self->timeout = $timeout;
    null !== $maxRetries && $self->maxRetries = $maxRetries;
    null !== $initialRetryDelay && $self
      ->initialRetryDelay = $initialRetryDelay;
    null !== $maxRetryDelay && $self->maxRetryDelay = $maxRetryDelay;
    null !== $extraHeaders && $self->extraHeaders = $extraHeaders;
    null !== $extraQueryParams && $self->extraQueryParams = $extraQueryParams;
    null !== $extraBodyParams && $self->extraBodyParams = $extraBodyParams;
    null !== $transporter && $self->transporter = $transporter;
    null !== $uriFactory && $self->uriFactory = $uriFactory;
    null !== $streamFactory && $self->streamFactory = $streamFactory;
    null !== $requestFactory && $self->requestFactory = $requestFactory;

    return $self;
  }

  /**
  * @param float $timeout
  *
  * @return self
 */
  public function withTimeout(float $timeout): self {
    $self = clone $this;
    $self->timeout = $timeout;
    return $self;
  }

  /**
  * @param int $maxRetries
  *
  * @return self
 */
  public function withMaxRetries(int $maxRetries): self {
    $self = clone $this;
    $self->maxRetries = $maxRetries;
    return $self;
  }

  /**
  * @param float $initialRetryDelay
  *
  * @return self
 */
  public function withInitialRetryDelay(float $initialRetryDelay): self {
    $self = clone $this;
    $self->initialRetryDelay = $initialRetryDelay;
    return $self;
  }

  /**
  * @param float $maxRetryDelay
  *
  * @return self
 */
  public function withMaxRetryDelay(float $maxRetryDelay): self {
    $self = clone $this;
    $self->maxRetryDelay = $maxRetryDelay;
    return $self;
  }

  /**
  * @param array<string,string|int|null|list<string|int>> $extraHeaders
  *
  * @return self
 */
  public function withExtraHeaders(array $extraHeaders): self {
    $self = clone $this;
    $self->extraHeaders = $extraHeaders;
    return $self;
  }

  /**
  * @param array<string,mixed> $extraQueryParams
  *
  * @return self
 */
  public function withExtraQueryParams(array $extraQueryParams): self {
    $self = clone $this;
    $self->extraQueryParams = $extraQueryParams;
    return $self;
  }

  /**
  * @param mixed $extraBodyParams
  *
  * @return self
 */
  public function withExtraBodyParams(mixed $extraBodyParams): self {
    $self = clone $this;
    $self->extraBodyParams = $extraBodyParams;
    return $self;
  }

  /**
  * @param ClientInterface $transporter
  *
  * @return self
 */
  public function withTransporter(ClientInterface $transporter): self {
    $self = clone $this;
    $self->transporter = $transporter;
    return $self;
  }

  /**
  * @param UriFactoryInterface $uriFactory
  *
  * @return self
 */
  public function withUriFactory(UriFactoryInterface $uriFactory): self {
    $self = clone $this;
    $self->uriFactory = $uriFactory;
    return $self;
  }

  /**
  * @param StreamFactoryInterface $streamFactory
  *
  * @return self
 */
  public function withStreamFactory(
    StreamFactoryInterface $streamFactory
  ): self {
    $self = clone $this;
    $self->streamFactory = $streamFactory;
    return $self;
  }

  /**
  * @param RequestFactoryInterface $requestFactory
  *
  * @return self
 */
  public function withRequestFactory(
    RequestFactoryInterface $requestFactory
  ): self {
    $self = clone $this;
    $self->requestFactory = $requestFactory;
    return $self;
  }

  function __construct() {$this->initialize();}
}
<?php

declare(strict_types=1);

namespace Believe\Webhooks\WebhookTriggerEventResponse;

use Believe\Core\Attributes\Required;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Result of delivering a webhook to a single endpoint.
  *
  * @phpstan-type DeliveryShape = array{
  *   success: bool,
  *   url: string,
  *   webhookID: string,
  *   error?: string|null,
  *   statusCode?: int|null,
  * }
  *
 */
final class Delivery implements BaseModel
{
  /** @use SdkModel<DeliveryShape> */
  use SdkModel;

  /**
  * Whether delivery was successful
  *
  * @var bool $success
 */
  #[Required]
  public bool $success;

  /**
  * URL the webhook was sent to
  *
  * @var string $url
 */
  #[Required]
  public string $url;

  /**
  * ID of the webhook
  *
  * @var string $webhookID
 */
  #[Required('webhook_id')]
  public string $webhookID;

  /**
  * Error message if delivery failed
  *
  * @var string|null $error
 */
  #[Optional(nullable: true)]
  public ?string $error;

  /**
  * HTTP status code from the endpoint
  *
  * @var int|null $statusCode
 */
  #[Optional('status_code', nullable: true)]
  public ?int $statusCode;

  /**
  * `new Delivery()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * Delivery::with(success: ..., url: ..., webhookID: ...)
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new Delivery)->withSuccess(...)->withURL(...)->withWebhookID(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param bool $success
  * @param string $url
  * @param string $webhookID
  * @param string|null $error
  * @param int|null $statusCode
  *
  * @return self
 */
  public static function with(
    bool $success,
    string $url,
    string $webhookID,
    ?string $error = null,
    ?int $statusCode = null,
  ): self {
    $self = new self;

    $self['success'] = $success;
    $self['url'] = $url;
    $self['webhookID'] = $webhookID;

    null !== $error && $self['error'] = $error;
    null !== $statusCode && $self['statusCode'] = $statusCode;

    return $self;
  }

  /**
  * Whether delivery was successful
  *
  * @param bool $success
  *
  * @return self
 */
  public function withSuccess(bool $success): self {
    $self = clone $this;
    $self['success'] = $success;
    return $self;
  }

  /**
  * URL the webhook was sent to
  *
  * @param string $url
  *
  * @return self
 */
  public function withURL(string $url): self {
    $self = clone $this;
    $self['url'] = $url;
    return $self;
  }

  /**
  * ID of the webhook
  *
  * @param string $webhookID
  *
  * @return self
 */
  public function withWebhookID(string $webhookID): self {
    $self = clone $this;
    $self['webhookID'] = $webhookID;
    return $self;
  }

  /**
  * Error message if delivery failed
  *
  * @param string|null $error
  *
  * @return self
 */
  public function withError(?string $error): self {
    $self = clone $this;
    $self['error'] = $error;
    return $self;
  }

  /**
  * HTTP status code from the endpoint
  *
  * @param int|null $statusCode
  *
  * @return self
 */
  public function withStatusCode(?int $statusCode): self {
    $self = clone $this;
    $self['statusCode'] = $statusCode;
    return $self;
  }
}
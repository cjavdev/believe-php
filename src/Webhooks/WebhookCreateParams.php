<?php

declare(strict_types=1);

namespace Believe\Webhooks;

use Believe\Core\Attributes\Required;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\Webhooks\WebhookCreateParams\EventType;

/**
  * Register a new webhook endpoint to receive event notifications.
  *
  * ## Event Types
  *
  * Available event types to subscribe to:
  * - `match.completed` - Fired when a football match ends
  * - `team_member.transferred` - Fired when a player/coach joins or leaves a team
  *
  * If no event types are specified, the webhook will receive all event types.
  *
  * ## Webhook Signatures
  *
  * All webhook deliveries include Standard Webhooks signature headers:
  * - `webhook-id` - Unique message identifier
  * - `webhook-timestamp` - Unix timestamp of when the webhook was sent
  * - `webhook-signature` - HMAC-SHA256 signature in format `v1,{base64_signature}`
  *
  * Store the returned `secret` securely - you'll need it to verify webhook signatures.
  * @see Believe\Services\WebhooksService::create()
  *
  * @phpstan-type WebhookCreateParamsShape = array{
  *   url: string,
  *   description?: string|null,
  *   eventTypes?: list<EventType|value-of<EventType>>|null,
  * }
  *
 */
final class WebhookCreateParams implements BaseModel
{
  /** @use SdkModel<WebhookCreateParamsShape> */
  use SdkModel;
  use SdkParams;

  /**
  * The URL to send webhook events to
  *
  * @var string $url
 */
  #[Required]
  public string $url;

  /**
  * Optional description for this webhook
  *
  * @var string|null $description
 */
  #[Optional(nullable: true)]
  public ?string $description;

  /**
  * List of event types to subscribe to. If not provided, subscribes to all events.
  *
  * @var list<value-of<EventType>>|null $eventTypes
 */
  #[Optional('event_types', list: EventType::class, nullable: true)]
  public ?array $eventTypes;

  /**
  * `new WebhookCreateParams()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * WebhookCreateParams::with(url: ...)
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new WebhookCreateParams)->withURL(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $url
  * @param string|null $description
  * @param list<EventType|value-of<EventType>>|null $eventTypes
  *
  * @return self
 */
  public static function with(
    string $url, ?string $description = null, ?array $eventTypes = null
  ): self {
    $self = new self;

    $self['url'] = $url;

    null !== $description && $self['description'] = $description;
    null !== $eventTypes && $self['eventTypes'] = $eventTypes;

    return $self;
  }

  /**
  * The URL to send webhook events to
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
  * Optional description for this webhook
  *
  * @param string|null $description
  *
  * @return self
 */
  public function withDescription(?string $description): self {
    $self = clone $this;
    $self['description'] = $description;
    return $self;
  }

  /**
  * List of event types to subscribe to. If not provided, subscribes to all events.
  *
  * @param list<EventType|value-of<EventType>>|null $eventTypes
  *
  * @return self
 */
  public function withEventTypes(?array $eventTypes): self {
    $self = clone $this;
    $self['eventTypes'] = $eventTypes;
    return $self;
  }
}
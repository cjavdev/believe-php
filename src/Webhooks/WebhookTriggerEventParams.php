<?php

declare(strict_types=1);

namespace Believe\Webhooks;

use Believe\Core\Attributes\Required;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\Webhooks\WebhookTriggerEventParams\Payload;
use Believe\Webhooks\WebhookTriggerEventParams\EventType;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\MatchCompletedPayload;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload;

/**
  * Trigger a webhook event and deliver it to all subscribed endpoints.
  *
  * This endpoint is useful for testing your webhook integration. It will:
  * 1. Generate an event with the specified type and payload
  * 2. Find all webhooks subscribed to that event type
  * 3. Send a POST request to each webhook URL with signature headers
  * 4. Return the delivery results
  *
  * ## Event Payload
  *
  * You can provide a custom payload, or leave it empty to use a sample payload.
  *
  * ## Webhook Signature Headers
  *
  * Each webhook delivery includes:
  * - `webhook-id` - Unique event identifier (e.g., `evt_abc123...`)
  * - `webhook-timestamp` - Unix timestamp
  * - `webhook-signature` - HMAC-SHA256 signature (`v1,{base64}`)
  *
  * To verify signatures, compute:
  * ```
  * signature = HMAC-SHA256(
  *     key = base64_decode(secret_without_prefix),
  *     message = "{timestamp}.{raw_json_payload}"
  * )
  * ```
  * @see Believe\Services\WebhooksService::triggerEvent()
  * @phpstan-import-type PayloadVariants from \Believe\Webhooks\WebhookTriggerEventParams\Payload
  * @phpstan-import-type PayloadShape from \Believe\Webhooks\WebhookTriggerEventParams\Payload
  * @phpstan-type WebhookTriggerEventParamsShape = array{
  *   eventType: EventType|value-of<EventType>, payload?: PayloadShape|null
  * }
  *
 */
final class WebhookTriggerEventParams implements BaseModel
{
  /** @use SdkModel<WebhookTriggerEventParamsShape> */
  use SdkModel;
  use SdkParams;

  /**
  * The type of event to trigger
  *
  * @var value-of<EventType> $eventType
 */
  #[Required('event_type', enum: EventType::class)]
  public string $eventType;

  /**
  * Optional event payload. If not provided, a sample payload will be generated.
  *
  * @var PayloadVariants|null $payload
 */
  #[Optional(union: Payload::class, nullable: true)]
  public null|MatchCompletedPayload|TeamMemberTransferredPayload $payload;

  /**
  * `new WebhookTriggerEventParams()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * WebhookTriggerEventParams::with(eventType: ...)
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new WebhookTriggerEventParams)->withEventType(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param EventType|value-of<EventType> $eventType
  * @param PayloadShape|null $payload
  *
  * @return self
 */
  public static function with(
    EventType|string $eventType,
    null|MatchCompletedPayload|array|TeamMemberTransferredPayload $payload = null,
  ): self {
    $self = new self;

    $self['eventType'] = $eventType;

    null !== $payload && $self['payload'] = $payload;

    return $self;
  }

  /**
  * The type of event to trigger
  *
  * @param EventType|value-of<EventType> $eventType
  *
  * @return self
 */
  public function withEventType(EventType|string $eventType): self {
    $self = clone $this;
    $self['eventType'] = $eventType;
    return $self;
  }

  /**
  * Optional event payload. If not provided, a sample payload will be generated.
  *
  * @param PayloadShape|null $payload
  *
  * @return self
 */
  public function withPayload(
    null|MatchCompletedPayload|array|TeamMemberTransferredPayload $payload
  ): self {
    $self = clone $this;
    $self['payload'] = $payload;
    return $self;
  }
}
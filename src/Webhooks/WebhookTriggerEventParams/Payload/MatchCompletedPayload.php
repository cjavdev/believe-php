<?php

declare(strict_types=1);

namespace Believe\Webhooks\WebhookTriggerEventParams\Payload;

use Believe\Core\Attributes\Required;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\MatchCompletedPayload\Data;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\MatchCompletedPayload\EventType;

/**
  * Payload for match.completed event.
  * @phpstan-import-type DataShape from \Believe\Webhooks\WebhookTriggerEventParams\Payload\MatchCompletedPayload\Data
  * @phpstan-type MatchCompletedPayloadShape = array{
  *   data: Data|DataShape, eventType?: null|EventType|value-of<EventType>
  * }
  *
 */
final class MatchCompletedPayload implements BaseModel
{
  /** @use SdkModel<MatchCompletedPayloadShape> */
  use SdkModel;

  /**
  * Event data
  *
  * @var Data $data
 */
  #[Required]
  public Data $data;

  /**
  * The type of webhook event
  *
  * @var value-of<EventType>|null $eventType
 */
  #[Optional('event_type', enum: EventType::class)]
  public ?string $eventType;

  /**
  * `new MatchCompletedPayload()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * MatchCompletedPayload::with(data: ...)
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new MatchCompletedPayload)->withData(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param Data|DataShape $data
  * @param null|EventType|value-of<EventType> $eventType
  *
  * @return self
 */
  public static function with(
    Data|array $data, EventType|string $eventType = null
  ): self {
    $self = new self;

    $self['data'] = $data;

    null !== $eventType && $self['eventType'] = $eventType;

    return $self;
  }

  /**
  * Event data
  *
  * @param Data|DataShape $data
  *
  * @return self
 */
  public function withData(Data|array $data): self {
    $self = clone $this;
    $self['data'] = $data;
    return $self;
  }

  /**
  * The type of webhook event
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
}
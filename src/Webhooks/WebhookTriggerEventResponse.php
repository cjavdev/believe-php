<?php

declare(strict_types=1);

namespace Believe\Webhooks;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\Webhooks\WebhookTriggerEventResponse\Delivery;
use Believe\Webhooks\WebhookTriggerEventResponse\EventType;

/**
 * Response after triggering webhook events.
 *
 * @phpstan-import-type DeliveryShape from \Believe\Webhooks\WebhookTriggerEventResponse\Delivery
 *
 * @phpstan-type WebhookTriggerEventResponseShape = array{
 *   deliveries: list<Delivery|DeliveryShape>,
 *   eventID: string,
 *   eventType: EventType|value-of<EventType>,
 *   successfulDeliveries: int,
 *   tedSays: string,
 *   totalWebhooks: int,
 * }
 */
final class WebhookTriggerEventResponse implements BaseModel
{
    /** @use SdkModel<WebhookTriggerEventResponseShape> */
    use SdkModel;

    /**
     * Results of webhook deliveries.
     *
     * @var list<Delivery> $deliveries
     */
    #[Required(list: Delivery::class)]
    public array $deliveries;

    /**
     * Unique event identifier.
     */
    #[Required('event_id')]
    public string $eventID;

    /**
     * The type of event triggered.
     *
     * @var value-of<EventType> $eventType
     */
    #[Required('event_type', enum: EventType::class)]
    public string $eventType;

    /**
     * Number of successful deliveries.
     */
    #[Required('successful_deliveries')]
    public int $successfulDeliveries;

    /**
     * Ted's reaction.
     */
    #[Required('ted_says')]
    public string $tedSays;

    /**
     * Total number of webhooks that received this event.
     */
    #[Required('total_webhooks')]
    public int $totalWebhooks;

    /**
     * `new WebhookTriggerEventResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookTriggerEventResponse::with(
     *   deliveries: ...,
     *   eventID: ...,
     *   eventType: ...,
     *   successfulDeliveries: ...,
     *   tedSays: ...,
     *   totalWebhooks: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookTriggerEventResponse)
     *   ->withDeliveries(...)
     *   ->withEventID(...)
     *   ->withEventType(...)
     *   ->withSuccessfulDeliveries(...)
     *   ->withTedSays(...)
     *   ->withTotalWebhooks(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Delivery|DeliveryShape> $deliveries
     * @param EventType|value-of<EventType> $eventType
     */
    public static function with(
        array $deliveries,
        string $eventID,
        EventType|string $eventType,
        int $successfulDeliveries,
        string $tedSays,
        int $totalWebhooks,
    ): self {
        $self = new self;

        $self['deliveries'] = $deliveries;
        $self['eventID'] = $eventID;
        $self['eventType'] = $eventType;
        $self['successfulDeliveries'] = $successfulDeliveries;
        $self['tedSays'] = $tedSays;
        $self['totalWebhooks'] = $totalWebhooks;

        return $self;
    }

    /**
     * Results of webhook deliveries.
     *
     * @param list<Delivery|DeliveryShape> $deliveries
     */
    public function withDeliveries(array $deliveries): self
    {
        $self = clone $this;
        $self['deliveries'] = $deliveries;

        return $self;
    }

    /**
     * Unique event identifier.
     */
    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }

    /**
     * The type of event triggered.
     *
     * @param EventType|value-of<EventType> $eventType
     */
    public function withEventType(EventType|string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * Number of successful deliveries.
     */
    public function withSuccessfulDeliveries(int $successfulDeliveries): self
    {
        $self = clone $this;
        $self['successfulDeliveries'] = $successfulDeliveries;

        return $self;
    }

    /**
     * Ted's reaction.
     */
    public function withTedSays(string $tedSays): self
    {
        $self = clone $this;
        $self['tedSays'] = $tedSays;

        return $self;
    }

    /**
     * Total number of webhooks that received this event.
     */
    public function withTotalWebhooks(int $totalWebhooks): self
    {
        $self = clone $this;
        $self['totalWebhooks'] = $totalWebhooks;

        return $self;
    }
}

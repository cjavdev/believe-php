<?php

declare(strict_types=1);

namespace Believe\Webhooks;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\Webhooks\TeamMemberTransferredWebhookEvent\Data;
use Believe\Webhooks\TeamMemberTransferredWebhookEvent\EventType;

/**
 * Webhook event sent when a team member (player, coach, staff) transfers between teams.
 *
 * @phpstan-import-type DataShape from \Believe\Webhooks\TeamMemberTransferredWebhookEvent\Data
 *
 * @phpstan-type TeamMemberTransferredWebhookEventShape = array{
 *   createdAt: \DateTimeInterface,
 *   data: Data|DataShape,
 *   eventID: string,
 *   eventType: EventType|value-of<EventType>,
 * }
 */
final class TeamMemberTransferredWebhookEvent implements BaseModel
{
    /** @use SdkModel<TeamMemberTransferredWebhookEventShape> */
    use SdkModel;

    /**
     * When the event was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Data payload for a team member transfer event.
     */
    #[Required]
    public Data $data;

    /**
     * Unique identifier for this event.
     */
    #[Required('event_id')]
    public string $eventID;

    /**
     * The type of webhook event.
     *
     * @var value-of<EventType> $eventType
     */
    #[Required('event_type', enum: EventType::class)]
    public string $eventType;

    /**
     * `new TeamMemberTransferredWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TeamMemberTransferredWebhookEvent::with(
     *   createdAt: ..., data: ..., eventID: ..., eventType: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TeamMemberTransferredWebhookEvent)
     *   ->withCreatedAt(...)
     *   ->withData(...)
     *   ->withEventID(...)
     *   ->withEventType(...)
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
     * @param Data|DataShape $data
     * @param EventType|value-of<EventType> $eventType
     */
    public static function with(
        \DateTimeInterface $createdAt,
        Data|array $data,
        string $eventID,
        EventType|string $eventType,
    ): self {
        $self = new self;

        $self['createdAt'] = $createdAt;
        $self['data'] = $data;
        $self['eventID'] = $eventID;
        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * When the event was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Data payload for a team member transfer event.
     *
     * @param Data|DataShape $data
     */
    public function withData(Data|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Unique identifier for this event.
     */
    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }

    /**
     * The type of webhook event.
     *
     * @param EventType|value-of<EventType> $eventType
     */
    public function withEventType(EventType|string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }
}

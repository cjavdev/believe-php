<?php

declare(strict_types=1);

namespace Believe\Webhooks\WebhookTriggerEventParams\Payload;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload\Data;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload\EventType;

/**
 * Payload for team_member.transferred event.
 *
 * @phpstan-import-type DataShape from \Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload\Data
 *
 * @phpstan-type TeamMemberTransferredPayloadShape = array{
 *   data: Data|DataShape, eventType?: null|EventType|value-of<EventType>
 * }
 */
final class TeamMemberTransferredPayload implements BaseModel
{
    /** @use SdkModel<TeamMemberTransferredPayloadShape> */
    use SdkModel;

    /**
     * Event data.
     */
    #[Required]
    public Data $data;

    /**
     * The type of webhook event.
     *
     * @var value-of<EventType>|null $eventType
     */
    #[Optional('event_type', enum: EventType::class)]
    public ?string $eventType;

    /**
     * `new TeamMemberTransferredPayload()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TeamMemberTransferredPayload::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TeamMemberTransferredPayload)->withData(...)
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
     * @param EventType|value-of<EventType>|null $eventType
     */
    public static function with(
        Data|array $data,
        EventType|string|null $eventType = null
    ): self {
        $self = new self;

        $self['data'] = $data;

        null !== $eventType && $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * Event data.
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

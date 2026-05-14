<?php

declare(strict_types=1);

namespace Believe\Webhooks;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\Webhooks\RegisteredWebhook\EventType;

/**
 * A registered webhook endpoint.
 *
 * @phpstan-type RegisteredWebhookShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   eventTypes: list<EventType|value-of<EventType>>,
 *   secret: string,
 *   url: string,
 *   description?: string|null,
 * }
 */
final class RegisteredWebhook implements BaseModel
{
    /** @use SdkModel<RegisteredWebhookShape> */
    use SdkModel;

    /**
     * Unique webhook identifier.
     */
    #[Required]
    public string $id;

    /**
     * When the webhook was registered.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * List of event types this webhook is subscribed to.
     *
     * @var list<value-of<EventType>> $eventTypes
     */
    #[Required('event_types', list: EventType::class)]
    public array $eventTypes;

    /**
     * The secret key for verifying webhook signatures (base64 encoded).
     */
    #[Required]
    public string $secret;

    /**
     * The URL to send webhook events to.
     */
    #[Required]
    public string $url;

    /**
     * Optional description for this webhook.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * `new RegisteredWebhook()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RegisteredWebhook::with(
     *   id: ..., createdAt: ..., eventTypes: ..., secret: ..., url: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RegisteredWebhook)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withEventTypes(...)
     *   ->withSecret(...)
     *   ->withURL(...)
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
     * @param list<EventType|value-of<EventType>> $eventTypes
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        array $eventTypes,
        string $secret,
        string $url,
        ?string $description = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['eventTypes'] = $eventTypes;
        $self['secret'] = $secret;
        $self['url'] = $url;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * Unique webhook identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * When the webhook was registered.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * List of event types this webhook is subscribed to.
     *
     * @param list<EventType|value-of<EventType>> $eventTypes
     */
    public function withEventTypes(array $eventTypes): self
    {
        $self = clone $this;
        $self['eventTypes'] = $eventTypes;

        return $self;
    }

    /**
     * The secret key for verifying webhook signatures (base64 encoded).
     */
    public function withSecret(string $secret): self
    {
        $self = clone $this;
        $self['secret'] = $secret;

        return $self;
    }

    /**
     * The URL to send webhook events to.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Optional description for this webhook.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}

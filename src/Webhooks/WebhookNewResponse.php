<?php

declare(strict_types=1);

namespace Believe\Webhooks;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
 * Response after registering a webhook.
 *
 * @phpstan-import-type RegisteredWebhookShape from \Believe\Webhooks\RegisteredWebhook
 *
 * @phpstan-type WebhookNewResponseShape = array{
 *   webhook: RegisteredWebhook|RegisteredWebhookShape,
 *   message?: string|null,
 *   tedSays?: string|null,
 * }
 */
final class WebhookNewResponse implements BaseModel
{
    /** @use SdkModel<WebhookNewResponseShape> */
    use SdkModel;

    /**
     * The registered webhook details.
     */
    #[Required]
    public RegisteredWebhook $webhook;

    /**
     * Status message.
     */
    #[Optional]
    public ?string $message;

    /**
     * Ted's reaction.
     */
    #[Optional('ted_says')]
    public ?string $tedSays;

    /**
     * `new WebhookNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookNewResponse::with(webhook: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookNewResponse)->withWebhook(...)
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
     * @param RegisteredWebhook|RegisteredWebhookShape $webhook
     */
    public static function with(
        RegisteredWebhook|array $webhook,
        ?string $message = null,
        ?string $tedSays = null,
    ): self {
        $self = new self;

        $self['webhook'] = $webhook;

        null !== $message && $self['message'] = $message;
        null !== $tedSays && $self['tedSays'] = $tedSays;

        return $self;
    }

    /**
     * The registered webhook details.
     *
     * @param RegisteredWebhook|RegisteredWebhookShape $webhook
     */
    public function withWebhook(RegisteredWebhook|array $webhook): self
    {
        $self = clone $this;
        $self['webhook'] = $webhook;

        return $self;
    }

    /**
     * Status message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

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
}

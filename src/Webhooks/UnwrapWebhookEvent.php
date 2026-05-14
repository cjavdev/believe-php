<?php

declare(strict_types=1);

namespace Believe\Webhooks;

use Believe\Core\Concerns\SdkUnion;
use Believe\Core\Conversion\Contracts\Converter;
use Believe\Core\Conversion\Contracts\ConverterSource;

/**
 * Webhook event sent when a match completes.
 *
 * @phpstan-import-type MatchCompletedWebhookEventShape from \Believe\Webhooks\MatchCompletedWebhookEvent
 * @phpstan-import-type TeamMemberTransferredWebhookEventShape from \Believe\Webhooks\TeamMemberTransferredWebhookEvent
 *
 * @phpstan-type UnwrapWebhookEventVariants = MatchCompletedWebhookEvent|TeamMemberTransferredWebhookEvent
 * @phpstan-type UnwrapWebhookEventShape = UnwrapWebhookEventVariants|MatchCompletedWebhookEventShape|TeamMemberTransferredWebhookEventShape
 */
final class UnwrapWebhookEvent implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            MatchCompletedWebhookEvent::class,
            TeamMemberTransferredWebhookEvent::class,
        ];
    }
}

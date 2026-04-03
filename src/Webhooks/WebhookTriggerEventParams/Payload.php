<?php

declare(strict_types=1);

namespace Believe\Webhooks\WebhookTriggerEventParams;

use Believe\Core\Concerns\SdkUnion;
use Believe\Core\Conversion\Contracts\ConverterSource;
use Believe\Core\Conversion\Contracts\Converter;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\MatchCompletedPayload;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload;

/**
  * Optional event payload. If not provided, a sample payload will be generated.
  * @phpstan-import-type MatchCompletedPayloadShape from \Believe\Webhooks\WebhookTriggerEventParams\Payload\MatchCompletedPayload
  * @phpstan-import-type TeamMemberTransferredPayloadShape from \Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload
  * @phpstan-type PayloadVariants = MatchCompletedPayload|TeamMemberTransferredPayload
  *
  * @phpstan-type PayloadShape = PayloadVariants|MatchCompletedPayloadShape|TeamMemberTransferredPayloadShape
  *
 */
final class Payload implements ConverterSource
{
  use SdkUnion;

  /** @return string */
  static function discriminator(): string {
    return 'eventType';
  }

  /**
  * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
 */
  static function variants(): array {
    return [
      'match.completed' => MatchCompletedPayload::class,
      'team_member.transferred' => TeamMemberTransferredPayload::class,
    ];
  }
}
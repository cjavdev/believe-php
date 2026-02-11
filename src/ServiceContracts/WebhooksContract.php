<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\Webhooks\RegisteredWebhook;
use Believe\Webhooks\WebhookNewResponse;
use Believe\Webhooks\WebhookTriggerEventParams\EventType;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\MatchCompletedPayload;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload;
use Believe\Webhooks\WebhookTriggerEventResponse;

/**
 * @phpstan-import-type PayloadShape from \Believe\Webhooks\WebhookTriggerEventParams\Payload
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface WebhooksContract
{
    /**
     * @api
     *
     * @param string $url The URL to send webhook events to
     * @param string|null $description Optional description for this webhook
     * @param list<\Believe\Webhooks\WebhookCreateParams\EventType|value-of<\Believe\Webhooks\WebhookCreateParams\EventType>>|null $eventTypes List of event types to subscribe to. If not provided, subscribes to all events.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $url,
        ?string $description = null,
        ?array $eventTypes = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebhookNewResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): RegisteredWebhook;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<RegisteredWebhook>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return array<string,mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): array;

    /**
     * @api
     *
     * @param EventType|value-of<EventType> $eventType The type of event to trigger
     * @param PayloadShape|null $payload Optional event payload. If not provided, a sample payload will be generated.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function triggerEvent(
        EventType|string $eventType,
        MatchCompletedPayload|array|TeamMemberTransferredPayload|null $payload = null,
        RequestOptions|array|null $requestOptions = null,
    ): WebhookTriggerEventResponse;
}

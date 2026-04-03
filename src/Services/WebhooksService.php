<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Conversion;
use Believe\Core\Util;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Exceptions\WebhookException;
use Believe\ServiceContracts\WebhooksContract;
use Believe\Webhooks\UnwrapWebhookEvent;
use Believe\Webhooks\WebhookNewResponse;
use Believe\Webhooks\RegisteredWebhook;
use Believe\Webhooks\WebhookTriggerEventResponse;
use Believe\Webhooks\MatchCompletedWebhookEvent;
use Believe\Webhooks\TeamMemberTransferredWebhookEvent;
use Believe\Webhooks\WebhookTriggerEventParams\EventType;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\MatchCompletedPayload;
use Believe\Webhooks\WebhookTriggerEventParams\Payload\TeamMemberTransferredPayload;

/**
  * Register webhook endpoints and trigger events for testing
  * @phpstan-import-type PayloadShape from \Believe\Webhooks\WebhookTriggerEventParams\Payload
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class WebhooksService implements WebhooksContract
{
  /**
  * @api
  *
  * @var WebhooksRawService $raw
 */
  public WebhooksRawService $raw;

  /**
  * @api
  *
  * Register a new webhook endpoint to receive event notifications.
  *
  * ## Event Types
  *
  * Available event types to subscribe to:
  * - `match.completed` - Fired when a football match ends
  * - `team_member.transferred` - Fired when a player/coach joins or leaves a team
  *
  * If no event types are specified, the webhook will receive all event types.
  *
  * ## Webhook Signatures
  *
  * All webhook deliveries include Standard Webhooks signature headers:
  * - `webhook-id` - Unique message identifier
  * - `webhook-timestamp` - Unix timestamp of when the webhook was sent
  * - `webhook-signature` - HMAC-SHA256 signature in format `v1,{base64_signature}`
  *
  * Store the returned `secret` securely - you'll need it to verify webhook signatures.
  *
  * @param string $url The URL to send webhook events to
  * @param string|null $description Optional description for this webhook
  * @param list<\Believe\Webhooks\WebhookCreateParams\EventType|value-of<\Believe\Webhooks\WebhookCreateParams\EventType>>|null $eventTypes List of event types to subscribe to. If not provided, subscribes to all events.
  * @param RequestOpts|null $requestOptions
  *
  * @return WebhookNewResponse
  *
  * @throws APIException
 */
  public function create(
    string $url,
    ?string $description = null,
    ?array $eventTypes = null,
    null|RequestOptions|array $requestOptions = null,
  ): WebhookNewResponse {
    $params = Util::removeNulls(
      [
        'url' => $url,
        'description' => $description,
        'eventTypes' => $eventTypes,
      ],
    );

    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @api
  *
  * Get details of a specific webhook endpoint.
  *
  * @param string $webhookID
  * @param RequestOpts|null $requestOptions
  *
  * @return RegisteredWebhook
  *
  * @throws APIException
 */
  public function retrieve(
    string $webhookID, null|RequestOptions|array $requestOptions = null
  ): RegisteredWebhook {
    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->retrieve($webhookID, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @api
  *
  * Get a list of all registered webhook endpoints.
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return list<RegisteredWebhook>
  *
  * @throws APIException
 */
  public function list(
    null|RequestOptions|array $requestOptions = null
  ): array {
    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->list(requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @api
  *
  * Unregister a webhook endpoint. It will no longer receive events.
  *
  * @param string $webhookID
  * @param RequestOpts|null $requestOptions
  *
  * @return array<string,mixed>
  *
  * @throws APIException
 */
  public function delete(
    string $webhookID, null|RequestOptions|array $requestOptions = null
  ): array {
    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->delete($webhookID, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @api
  *
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
  *
  * @param EventType|value-of<EventType> $eventType The type of event to trigger
  * @param PayloadShape|null $payload Optional event payload. If not provided, a sample payload will be generated.
  * @param RequestOpts|null $requestOptions
  *
  * @return WebhookTriggerEventResponse
  *
  * @throws APIException
 */
  public function triggerEvent(
    EventType|string $eventType,
    null|MatchCompletedPayload|array|TeamMemberTransferredPayload $payload = null,
    null|RequestOptions|array $requestOptions = null,
  ): WebhookTriggerEventResponse {
    $params = Util::removeNulls(
      ['eventType' => $eventType, 'payload' => $payload]
    );

    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->triggerEvent(params: $params, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @api
  *
  * Unwraps a webhook event from its JSON representation.
  *
  * @param string $body
  *
  * @return MatchCompletedWebhookEvent|TeamMemberTransferredWebhookEvent
  *
  * @throws WebhookException
 */
  public function unwrap(
    string $body
  ): MatchCompletedWebhookEvent|TeamMemberTransferredWebhookEvent {
    try {
        $decoded = Util::decodeJson($body);
        // @phpstan-ignore return.type
        return Conversion::coerce(UnwrapWebhookEvent::class, value: $decoded);
    } catch (\Throwable $e) {
        throw new WebhookException('Error parsing webhook body', previous: $e);
    }
  }

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new WebhooksRawService($client);
  }
}
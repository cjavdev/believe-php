<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Conversion\ListOf;
use Believe\Core\Conversion\MapOf;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\WebhooksRawContract;
use Believe\Webhooks\WebhookCreateParams;
use Believe\Webhooks\WebhookNewResponse;
use Believe\Webhooks\RegisteredWebhook;
use Believe\Webhooks\WebhookTriggerEventParams;
use Believe\Webhooks\WebhookTriggerEventResponse;
use Believe\Webhooks\WebhookTriggerEventParams\EventType;

/**
  * Register webhook endpoints and trigger events for testing
  * @phpstan-import-type PayloadShape from \Believe\Webhooks\WebhookTriggerEventParams\Payload
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class WebhooksRawService implements WebhooksRawContract
{
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
  * @param array{
  *   url: string,
  *   description?: string|null,
  *   eventTypes?: list<\Believe\Webhooks\WebhookCreateParams\EventType|value-of<\Believe\Webhooks\WebhookCreateParams\EventType>>|null,
  * }|WebhookCreateParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<WebhookNewResponse>
  *
  * @throws APIException
 */
  public function create(
    array|WebhookCreateParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = WebhookCreateParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'post',
      path: 'webhooks',
      body: (object) $parsed,
      options: $options,
      convert: WebhookNewResponse::class,
    );
  }

  /**
  * @api
  *
  * Get details of a specific webhook endpoint.
  *
  * @param string $webhookID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<RegisteredWebhook>
  *
  * @throws APIException
 */
  public function retrieve(
    string $webhookID, null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: ['webhooks/%1$s', $webhookID],
      options: $requestOptions,
      convert: RegisteredWebhook::class,
    );
  }

  /**
  * @api
  *
  * Get a list of all registered webhook endpoints.
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<list<RegisteredWebhook>>
  *
  * @throws APIException
 */
  public function list(
    null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'get',
      path: 'webhooks',
      options: $requestOptions,
      convert: new ListOf(RegisteredWebhook::class),
    );
  }

  /**
  * @api
  *
  * Unregister a webhook endpoint. It will no longer receive events.
  *
  * @param string $webhookID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<array<string,mixed>>
  *
  * @throws APIException
 */
  public function delete(
    string $webhookID, null|RequestOptions|array $requestOptions = null
  ): BaseResponse {
    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'delete',
      path: ['webhooks/%1$s', $webhookID],
      options: $requestOptions,
      convert: new MapOf('mixed'),
    );
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
  * @param array{
  *   eventType: EventType|value-of<EventType>, payload?: PayloadShape|null
  * }|WebhookTriggerEventParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<WebhookTriggerEventResponse>
  *
  * @throws APIException
 */
  public function triggerEvent(
    array|WebhookTriggerEventParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = WebhookTriggerEventParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'post',
      path: 'webhooks/trigger',
      body: (object) $parsed,
      options: $options,
      convert: WebhookTriggerEventResponse::class,
    );
  }

  // @phpstan-ignore-next-line
  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {}
}
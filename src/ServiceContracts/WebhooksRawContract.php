<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\Webhooks\RegisteredWebhook;
use Believe\Webhooks\WebhookCreateParams;
use Believe\Webhooks\WebhookNewResponse;
use Believe\Webhooks\WebhookTriggerEventParams;
use Believe\Webhooks\WebhookTriggerEventResponse;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface WebhooksRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|WebhookCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|WebhookCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RegisteredWebhook>
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<RegisteredWebhook>>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<array<string,mixed>>
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|WebhookTriggerEventParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookTriggerEventResponse>
     *
     * @throws APIException
     */
    public function triggerEvent(
        array|WebhookTriggerEventParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

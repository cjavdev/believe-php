<?php

declare(strict_types=1);

namespace Believe\ServiceContracts\Client;

use Believe\Client\TicketSales\TicketSaleCreateParams;
use Believe\Client\TicketSales\TicketSaleGetResponse;
use Believe\Client\TicketSales\TicketSaleListParams;
use Believe\Client\TicketSales\TicketSaleListResponse;
use Believe\Client\TicketSales\TicketSaleNewResponse;
use Believe\Client\TicketSales\TicketSaleUpdateParams;
use Believe\Client\TicketSales\TicketSaleUpdateResponse;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\SkipLimitPage;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface TicketSalesRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|TicketSaleCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TicketSaleNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|TicketSaleCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TicketSaleGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $ticketSaleID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TicketSaleUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TicketSaleUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $ticketSaleID,
        array|TicketSaleUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|TicketSaleListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<TicketSaleListResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|TicketSaleListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $ticketSaleID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}

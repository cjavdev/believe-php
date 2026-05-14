<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\TicketSales\TicketSale;
use Believe\TicketSales\TicketSaleCreateParams;
use Believe\TicketSales\TicketSaleListParams;
use Believe\TicketSales\TicketSaleUpdateParams;

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
     * @return BaseResponse<TicketSale>
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
     * @return BaseResponse<TicketSale>
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
     * @return BaseResponse<TicketSale>
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
     * @return BaseResponse<SkipLimitPage<TicketSale>>
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

<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\SkipLimitPage;
use Believe\RequestOptions;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\TicketSales\TicketSaleCreateParams;
use Believe\TicketSales\TicketSale;
use Believe\TicketSales\TicketSaleUpdateParams;
use Believe\TicketSales\TicketSaleListParams;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface TicketSalesRawContract{

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
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $ticketSaleID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<TicketSale>
  *
  * @throws APIException
 */
    public function retrieve(
      string $ticketSaleID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $ticketSaleID
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
      null|RequestOptions|array $requestOptions = null,
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
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $ticketSaleID
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
    public function delete(
      string $ticketSaleID, null|RequestOptions|array $requestOptions = null
    ): BaseResponse;

}
<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Biscuits\Biscuit;
use Believe\Biscuits\BiscuitListParams;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\SkipLimitPage;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface BiscuitsRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Biscuit>
     *
     * @throws APIException
     */
    public function retrieve(
        string $biscuitID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BiscuitListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<Biscuit>>
     *
     * @throws APIException
     */
    public function list(
        array|BiscuitListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Biscuit>
     *
     * @throws APIException
     */
    public function getFresh(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}

<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Press\PressSimulateParams;
use Believe\Press\PressSimulateResponse;
use Believe\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface PressRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|PressSimulateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PressSimulateResponse>
     *
     * @throws APIException
     */
    public function simulate(
        array|PressSimulateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

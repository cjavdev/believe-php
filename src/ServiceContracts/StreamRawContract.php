<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface StreamRawContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function testConnection(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}

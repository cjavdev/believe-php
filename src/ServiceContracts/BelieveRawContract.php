<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Believe\BelieveSubmitParams;
use Believe\Believe\BelieveSubmitResponse;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface BelieveRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|BelieveSubmitParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BelieveSubmitResponse>
     *
     * @throws APIException
     */
    public function submit(
        array|BelieveSubmitParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

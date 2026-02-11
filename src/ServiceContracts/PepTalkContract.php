<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Core\Exceptions\APIException;
use Believe\PepTalk\PepTalkGetResponse;
use Believe\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface PepTalkContract
{
    /**
     * @api
     *
     * @param bool $stream If true, returns SSE stream instead of full response
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        bool $stream = false,
        RequestOptions|array|null $requestOptions = null
    ): PepTalkGetResponse;
}

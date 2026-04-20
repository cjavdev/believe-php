<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Conflicts\ConflictResolveParams;
use Believe\Conflicts\ConflictResolveResponse;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface ConflictsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|ConflictResolveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ConflictResolveResponse>
     *
     * @throws APIException
     */
    public function resolve(
        array|ConflictResolveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

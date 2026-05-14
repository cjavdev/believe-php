<?php

declare(strict_types=1);

namespace Believe\ServiceContracts\Matches;

use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface CommentaryContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function stream(
        string $matchID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}

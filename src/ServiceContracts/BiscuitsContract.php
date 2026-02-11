<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Biscuits\Biscuit;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\SkipLimitPage;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface BiscuitsContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $biscuitID,
        RequestOptions|array|null $requestOptions = null
    ): Biscuit;

    /**
     * @api
     *
     * @param int $limit Maximum number of items to return (max: 100)
     * @param int $skip Number of items to skip (offset)
     * @param RequestOpts|null $requestOptions
     *
     * @return SkipLimitPage<Biscuit>
     *
     * @throws APIException
     */
    public function list(
        int $limit = 20,
        int $skip = 0,
        RequestOptions|array|null $requestOptions = null,
    ): SkipLimitPage;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getFresh(
        RequestOptions|array|null $requestOptions = null
    ): Biscuit;
}

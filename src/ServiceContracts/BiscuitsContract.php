<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Biscuits\Biscuit;
use Believe\Core\Exceptions\APIException;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface BiscuitsContract{

    /**
  * @api
  *
  * @param string $biscuitID
  * @param RequestOpts|null $requestOptions
  *
  * @return Biscuit
  *
  * @throws APIException
 */
    public function retrieve(
      string $biscuitID, null|RequestOptions|array $requestOptions = null
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
      null|RequestOptions|array $requestOptions = null,
    ): SkipLimitPage;

    /**
  * @api
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return Biscuit
  *
  * @throws APIException
 */
    public function getFresh(
      null|RequestOptions|array $requestOptions = null
    ): Biscuit;

}
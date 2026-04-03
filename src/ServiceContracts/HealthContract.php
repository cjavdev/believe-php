<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\Core\Exceptions\APIException;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface HealthContract{

    /**
  * @api
  *
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
    public function check(
      null|RequestOptions|array $requestOptions = null
    ): mixed;

}
<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\Core\Exceptions\APIException;
use Believe\Press\PressSimulateResponse;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface PressContract{

    /**
  * @api
  *
  * @param string $question The press question to answer
  * @param bool $hostile Is this a hostile question from Trent Crimm?
  * @param string|null $topic Topic category
  * @param RequestOpts|null $requestOptions
  *
  * @return PressSimulateResponse
  *
  * @throws APIException
 */
    public function simulate(
      string $question,
      bool $hostile = false,
      ?string $topic = null,
      null|RequestOptions|array $requestOptions = null,
    ): PressSimulateResponse;

}
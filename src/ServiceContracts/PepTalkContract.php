<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\Core\Exceptions\APIException;
use Believe\PepTalk\PepTalkGetResponse;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface PepTalkContract{

    /**
  * @api
  *
  * @param bool $stream If true, returns SSE stream instead of full response
  * @param RequestOpts|null $requestOptions
  *
  * @return PepTalkGetResponse
  *
  * @throws APIException
 */
    public function retrieve(
      bool $stream = false, null|RequestOptions|array $requestOptions = null
    ): PepTalkGetResponse;

}
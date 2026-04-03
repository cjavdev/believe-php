<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\PepTalk\PepTalkGetResponse;
use Believe\PepTalk\PepTalkRetrieveParams;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface PepTalkRawContract{

    /**
  * @api
  *
  * @param array<string,mixed>|PepTalkRetrieveParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<PepTalkGetResponse>
  *
  * @throws APIException
 */
    public function retrieve(
      array|PepTalkRetrieveParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

}
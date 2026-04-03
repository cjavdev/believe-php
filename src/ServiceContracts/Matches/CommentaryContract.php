<?php

declare(strict_types=1);

namespace Believe\ServiceContracts\Matches;

use Believe\RequestOptions;
use Believe\Core\Exceptions\APIException;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface CommentaryContract{

    /**
  * @api
  *
  * @param string $matchID
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
    public function stream(
      string $matchID, null|RequestOptions|array $requestOptions = null
    ): mixed;

}
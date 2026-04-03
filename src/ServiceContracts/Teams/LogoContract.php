<?php

declare(strict_types=1);

namespace Believe\ServiceContracts\Teams;

use Believe\RequestOptions;
use Believe\Core\Exceptions\APIException;
use Believe\Teams\Logo\FileUpload;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface LogoContract{

    /**
  * @api
  *
  * @param string $fileID
  * @param string $teamID
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
    public function delete(
      string $fileID,
      string $teamID,
      null|RequestOptions|array $requestOptions = null,
    ): mixed;

    /**
  * @api
  *
  * @param string $fileID
  * @param string $teamID
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
    public function download(
      string $fileID,
      string $teamID,
      null|RequestOptions|array $requestOptions = null,
    ): mixed;

    /**
  * @api
  *
  * @param string $teamID
  * @param string $file Logo image file
  * @param RequestOpts|null $requestOptions
  *
  * @return FileUpload
  *
  * @throws APIException
 */
    public function upload(
      string $teamID,
      string $file,
      null|RequestOptions|array $requestOptions = null,
    ): FileUpload;

}
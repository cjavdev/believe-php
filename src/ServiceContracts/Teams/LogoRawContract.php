<?php

declare(strict_types=1);

namespace Believe\ServiceContracts\Teams;

use Believe\RequestOptions;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Teams\Logo\FileUpload;
use Believe\Teams\Logo\LogoDeleteParams;
use Believe\Teams\Logo\LogoDownloadParams;
use Believe\Teams\Logo\LogoUploadParams;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface LogoRawContract{

    /**
  * @api
  *
  * @param string $fileID
  * @param array<string,mixed>|LogoDeleteParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
    public function delete(
      string $fileID,
      array|LogoDeleteParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $fileID
  * @param array<string,mixed>|LogoDownloadParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<mixed>
  *
  * @throws APIException
 */
    public function download(
      string $fileID,
      array|LogoDownloadParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

    /**
  * @api
  *
  * @param string $teamID
  * @param array<string,mixed>|LogoUploadParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<FileUpload>
  *
  * @throws APIException
 */
    public function upload(
      string $teamID,
      array|LogoUploadParams $params,
      null|RequestOptions|array $requestOptions = null,
    ): BaseResponse;

}
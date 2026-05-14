<?php

declare(strict_types=1);

namespace Believe\ServiceContracts\Teams;

use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\Teams\Logo\FileUpload;
use Believe\Teams\Logo\LogoDeleteParams;
use Believe\Teams\Logo\LogoDownloadParams;
use Believe\Teams\Logo\LogoUploadParams;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface LogoRawContract
{
    /**
     * @api
     *
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
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
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
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
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
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}

<?php

declare(strict_types=1);

namespace Believe\ServiceContracts\Teams;

use Believe\Core\Exceptions\APIException;
use Believe\Core\FileParam;
use Believe\RequestOptions;
use Believe\Teams\Logo\FileUpload;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface LogoContract
{
    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $fileID,
        string $teamID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function download(
        string $fileID,
        string $teamID,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param string|FileParam $file Logo image file
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function upload(
        string $teamID,
        string|FileParam $file,
        RequestOptions|array|null $requestOptions = null,
    ): FileUpload;
}

<?php

declare(strict_types=1);

namespace Believe\Services\Teams;

use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Core\FileParam;
use Believe\RequestOptions;
use Believe\ServiceContracts\Teams\LogoRawContract;
use Believe\Teams\Logo\FileUpload;
use Believe\Teams\Logo\LogoDeleteParams;
use Believe\Teams\Logo\LogoDownloadParams;
use Believe\Teams\Logo\LogoUploadParams;

/**
 * Operations related to football teams.
 *
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class LogoRawService implements LogoRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Delete a team's logo.
     *
     * @param array{teamID: string}|LogoDeleteParams $params
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
    ): BaseResponse {
        [$parsed, $options] = LogoDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $teamID = $parsed['teamID'];
        unset($parsed['teamID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['teams/%1$s/logo/%2$s', $teamID, $fileID],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Download a team's logo by file ID.
     *
     * @param array{teamID: string}|LogoDownloadParams $params
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
    ): BaseResponse {
        [$parsed, $options] = LogoDownloadParams::parseRequest(
            $params,
            $requestOptions,
        );
        $teamID = $parsed['teamID'];
        unset($parsed['teamID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['teams/%1$s/logo/%2$s', $teamID, $fileID],
            options: $options,
            convert: 'mixed',
        );
    }

    /**
     * @api
     *
     * Upload a logo image for a team. Accepts image files (jpg, png, gif, webp).
     *
     * @param array{file: string|FileParam}|LogoUploadParams $params
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
    ): BaseResponse {
        [$parsed, $options] = LogoUploadParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['teams/%1$s/logo', $teamID],
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
            convert: FileUpload::class,
        );
    }
}

<?php

declare(strict_types=1);

namespace Believe\Services\Teams;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\Teams\LogoRawContract;
use Believe\Teams\Logo\LogoDeleteParams;
use Believe\Teams\Logo\LogoDownloadParams;
use Believe\Teams\Logo\LogoUploadParams;
use Believe\Teams\Logo\FileUpload;

/**
  * Operations related to football teams
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class LogoRawService implements LogoRawContract
{
  /**
  * @api
  *
  * Delete a team's logo.
  *
  * @param string $fileID
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
    null|RequestOptions|array $requestOptions = null,
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
  * @param string $fileID
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
    null|RequestOptions|array $requestOptions = null,
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
  * @param string $teamID
  * @param array{file: string}|LogoUploadParams $params
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

  // @phpstan-ignore-next-line
  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {}
}
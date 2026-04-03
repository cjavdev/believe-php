<?php

declare(strict_types=1);

namespace Believe\Services\Teams;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Core\Util;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\Teams\LogoContract;
use Believe\Teams\Logo\FileUpload;

/**
  * Operations related to football teams
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class LogoService implements LogoContract
{
  /**
  * @api
  *
  * @var LogoRawService $raw
 */
  public LogoRawService $raw;

  /**
  * @api
  *
  * Delete a team's logo.
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
  ): mixed {
    $params = Util::removeNulls(['teamID' => $teamID]);

    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->delete($fileID, params: $params, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @api
  *
  * Download a team's logo by file ID.
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
  ): mixed {
    $params = Util::removeNulls(['teamID' => $teamID]);

    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->download($fileID, params: $params, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @api
  *
  * Upload a logo image for a team. Accepts image files (jpg, png, gif, webp).
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
  ): FileUpload {
    $params = Util::removeNulls(['file' => $file]);

    // @phpstan-ignore-next-line argument.type
    $response = $this->raw->upload($teamID, params: $params, requestOptions: $requestOptions);

    return $response->parse();
  }

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new LogoRawService($client);
  }
}
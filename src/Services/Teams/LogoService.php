<?php

declare(strict_types=1);

namespace Believe\Services\Teams;

use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\Core\FileParam;
use Believe\Core\Util;
use Believe\RequestOptions;
use Believe\ServiceContracts\Teams\LogoContract;
use Believe\Teams\Logo\FileUpload;

/**
 * Operations related to football teams.
 *
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class LogoService implements LogoContract
{
    /**
     * @api
     */
    public LogoRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LogoRawService($client);
    }

    /**
     * @api
     *
     * Delete a team's logo.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $fileID,
        string $teamID,
        RequestOptions|array|null $requestOptions = null,
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function download(
        string $fileID,
        string $teamID,
        RequestOptions|array|null $requestOptions = null,
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
     * @param string|FileParam $file Logo image file
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function upload(
        string $teamID,
        string|FileParam $file,
        RequestOptions|array|null $requestOptions = null,
    ): FileUpload {
        $params = Util::removeNulls(['file' => $file]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->upload($teamID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Reframe\ReframeTransformNegativeThoughtsParams;
use Believe\Reframe\ReframeTransformNegativeThoughtsResponse;
use Believe\RequestOptions;
use Believe\ServiceContracts\ReframeRawContract;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class ReframeRawService implements ReframeRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Transform negative thoughts into positive perspectives with Ted's help.
     *
     * @param array{
     *   negativeThought: string, recurring?: bool
     * }|ReframeTransformNegativeThoughtsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ReframeTransformNegativeThoughtsResponse>
     *
     * @throws APIException
     */
    public function transformNegativeThoughts(
        array|ReframeTransformNegativeThoughtsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ReframeTransformNegativeThoughtsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'reframe',
            body: (object) $parsed,
            options: $options,
            convert: ReframeTransformNegativeThoughtsResponse::class,
        );
    }
}

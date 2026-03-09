<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Believe\BelieveSubmitParams;
use Believe\Believe\BelieveSubmitParams\SituationType;
use Believe\Believe\BelieveSubmitResponse;
use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\ServiceContracts\BelieveRawContract;

/**
 * Interactive endpoints for motivation and guidance.
 *
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class BelieveRawService implements BelieveRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Submit your situation and receive Ted Lasso-style motivational guidance.
     *
     * @param array{
     *   situation: string,
     *   situationType: value-of<SituationType>,
     *   context?: string|null,
     *   intensity?: int,
     * }|BelieveSubmitParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BelieveSubmitResponse>
     *
     * @throws APIException
     */
    public function submit(
        array|BelieveSubmitParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BelieveSubmitParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'believe',
            body: (object) $parsed,
            options: $options,
            convert: BelieveSubmitResponse::class,
        );
    }
}

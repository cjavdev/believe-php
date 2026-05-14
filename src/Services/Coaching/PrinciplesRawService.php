<?php

declare(strict_types=1);

namespace Believe\Services\Coaching;

use Believe\Client;
use Believe\Coaching\Principles\CoachingPrinciple;
use Believe\Coaching\Principles\PrincipleListParams;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;
use Believe\ServiceContracts\Coaching\PrinciplesRawContract;
use Believe\SkipLimitPage;

/**
 * Interactive endpoints for motivation and guidance.
 *
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class PrinciplesRawService implements PrinciplesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get details about a specific coaching principle.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CoachingPrinciple>
     *
     * @throws APIException
     */
    public function retrieve(
        string $principleID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['coaching/principles/%1$s', $principleID],
            options: $requestOptions,
            convert: CoachingPrinciple::class,
        );
    }

    /**
     * @api
     *
     * Get a paginated list of Ted Lasso's core coaching principles and philosophy.
     *
     * @param array{limit?: int, skip?: int}|PrincipleListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<CoachingPrinciple>>
     *
     * @throws APIException
     */
    public function list(
        array|PrincipleListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PrincipleListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'coaching/principles',
            query: $parsed,
            options: $options,
            convert: CoachingPrinciple::class,
            page: SkipLimitPage::class,
        );
    }

    /**
     * @api
     *
     * Get a random coaching principle to inspire your day.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CoachingPrinciple>
     *
     * @throws APIException
     */
    public function getRandom(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'coaching/principles/random',
            options: $requestOptions,
            convert: CoachingPrinciple::class,
        );
    }
}

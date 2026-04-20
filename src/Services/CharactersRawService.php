<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Characters\CharacterCreateParams;
use Believe\Characters\CharacterListParams;
use Believe\Characters\CharacterRole;
use Believe\Characters\CharacterUpdateParams;
use Believe\Characters\Characterz;
use Believe\Characters\EmotionalStats;
use Believe\Characters\GrowthArc;
use Believe\Client;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Conversion\ListOf;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\RequestOptions;
use Believe\ServiceContracts\CharactersRawContract;
use Believe\SkipLimitPage;

/**
 * Operations related to Ted Lasso characters.
 *
 * @phpstan-import-type SalaryGbpShape from \Believe\Characters\CharacterCreateParams\SalaryGbp
 * @phpstan-import-type SalaryGbpShape from \Believe\Characters\CharacterUpdateParams\SalaryGbp as SalaryGbpShape1
 * @phpstan-import-type EmotionalStatsShape from \Believe\Characters\EmotionalStats
 * @phpstan-import-type GrowthArcShape from \Believe\Characters\GrowthArc
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class CharactersRawService implements CharactersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Add a new character to the Ted Lasso universe.
     *
     * @param array{
     *   background: string,
     *   emotionalStats: EmotionalStats|EmotionalStatsShape,
     *   name: string,
     *   personalityTraits: list<string>,
     *   role: value-of<CharacterRole>,
     *   dateOfBirth?: string|null,
     *   email?: string|null,
     *   growthArcs?: list<GrowthArc|GrowthArcShape>,
     *   heightMeters?: float|null,
     *   profileImageURL?: string|null,
     *   salaryGbp?: SalaryGbpShape|null,
     *   signatureQuotes?: list<string>,
     *   teamID?: string|null,
     * }|CharacterCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Characterz>
     *
     * @throws APIException
     */
    public function create(
        array|CharacterCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CharacterCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'characters',
            body: (object) $parsed,
            options: $options,
            convert: Characterz::class,
        );
    }

    /**
     * @api
     *
     * Retrieve detailed information about a specific character.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Characterz>
     *
     * @throws APIException
     */
    public function retrieve(
        string $characterID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['characters/%1$s', $characterID],
            options: $requestOptions,
            convert: Characterz::class,
        );
    }

    /**
     * @api
     *
     * Update specific fields of an existing character.
     *
     * @param array{
     *   background?: string|null,
     *   dateOfBirth?: string|null,
     *   email?: string|null,
     *   emotionalStats?: EmotionalStats|EmotionalStatsShape|null,
     *   growthArcs?: list<GrowthArc|GrowthArcShape>|null,
     *   heightMeters?: float|null,
     *   name?: string|null,
     *   personalityTraits?: list<string>|null,
     *   profileImageURL?: string|null,
     *   role?: value-of<CharacterRole>,
     *   salaryGbp?: SalaryGbpShape1|null,
     *   signatureQuotes?: list<string>|null,
     *   teamID?: string|null,
     * }|CharacterUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Characterz>
     *
     * @throws APIException
     */
    public function update(
        string $characterID,
        array|CharacterUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CharacterUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['characters/%1$s', $characterID],
            body: (object) $parsed,
            options: $options,
            convert: Characterz::class,
        );
    }

    /**
     * @api
     *
     * Get a paginated list of Ted Lasso characters.
     *
     * @param array{
     *   limit?: int,
     *   minOptimism?: int|null,
     *   role?: value-of<CharacterRole>,
     *   skip?: int,
     *   teamID?: string|null,
     * }|CharacterListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SkipLimitPage<Characterz>>
     *
     * @throws APIException
     */
    public function list(
        array|CharacterListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CharacterListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'characters',
            query: Util::array_transform_keys(
                $parsed,
                ['minOptimism' => 'min_optimism', 'teamID' => 'team_id']
            ),
            options: $options,
            convert: Characterz::class,
            page: SkipLimitPage::class,
        );
    }

    /**
     * @api
     *
     * Remove a character from the database.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $characterID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['characters/%1$s', $characterID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Get all signature quotes from a specific character.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<string>>
     *
     * @throws APIException
     */
    public function getQuotes(
        string $characterID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['characters/%1$s/quotes', $characterID],
            options: $requestOptions,
            convert: new ListOf('string'),
        );
    }
}

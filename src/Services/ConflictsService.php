<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Conflicts\ConflictResolveParams\ConflictType;
use Believe\Conflicts\ConflictResolveResponse;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\RequestOptions;
use Believe\ServiceContracts\ConflictsContract;

/**
 * Interactive endpoints for motivation and guidance.
 *
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class ConflictsService implements ConflictsContract
{
    /**
     * @api
     */
    public ConflictsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ConflictsRawService($client);
    }

    /**
     * @api
     *
     * Get Ted Lasso-style advice for resolving conflicts.
     *
     * @param ConflictType|value-of<ConflictType> $conflictType Type of conflict
     * @param string $description Describe the conflict
     * @param list<string> $partiesInvolved Who is involved in the conflict
     * @param list<string>|null $attemptsMade What you've already tried
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function resolve(
        ConflictType|string $conflictType,
        string $description,
        array $partiesInvolved,
        ?array $attemptsMade = null,
        RequestOptions|array|null $requestOptions = null,
    ): ConflictResolveResponse {
        $params = Util::removeNulls(
            [
                'conflictType' => $conflictType,
                'description' => $description,
                'partiesInvolved' => $partiesInvolved,
                'attemptsMade' => $attemptsMade,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->resolve(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

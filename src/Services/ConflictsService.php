<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Conflicts\ConflictResolveResponse;
use Believe\Conflicts\ConflictResolveParams\ConflictType;
use Believe\Core\Util;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\ConflictsContract;

/**
  * Interactive endpoints for motivation and guidance
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class ConflictsService implements ConflictsContract
{
  /**
  * @api
  *
  * @var ConflictsRawService $raw
 */
  public ConflictsRawService $raw;

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
  * @return ConflictResolveResponse
  *
  * @throws APIException
 */
  public function resolve(
    ConflictType|string $conflictType,
    string $description,
    array $partiesInvolved,
    ?array $attemptsMade = null,
    null|RequestOptions|array $requestOptions = null,
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

  /**
  * @internal
  *
  * @param Client $client
 */
  function __construct(protected Client $client) {
    $this->raw = new ConflictsRawService($client);
  }
}
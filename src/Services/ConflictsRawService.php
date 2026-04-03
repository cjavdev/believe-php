<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\RequestOptions;
use Believe\Client;
use Believe\Conflicts\ConflictResolveParams;
use Believe\Conflicts\ConflictResolveResponse;
use Believe\Conflicts\ConflictResolveParams\ConflictType;
use Believe\Core\Contracts\BaseResponse;
use Believe\Core\Exceptions\APIException;
use Believe\ServiceContracts\ConflictsRawContract;

/**
  * Interactive endpoints for motivation and guidance
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
final class ConflictsRawService implements ConflictsRawContract
{
  /**
  * @api
  *
  * Get Ted Lasso-style advice for resolving conflicts.
  *
  * @param array{
  *   conflictType: value-of<ConflictType>,
  *   description: string,
  *   partiesInvolved: list<string>,
  *   attemptsMade?: list<string>|null,
  * }|ConflictResolveParams $params
  * @param RequestOpts|null $requestOptions
  *
  * @return BaseResponse<ConflictResolveResponse>
  *
  * @throws APIException
 */
  public function resolve(
    array|ConflictResolveParams $params,
    null|RequestOptions|array $requestOptions = null,
  ): BaseResponse {
    [$parsed, $options] = ConflictResolveParams::parseRequest(
      $params,
      $requestOptions,
    );

    // @phpstan-ignore-next-line return.type
    return $this->client->request(
      method: 'post',
      path: 'conflicts/resolve',
      body: (object) $parsed,
      options: $options,
      convert: ConflictResolveResponse::class,
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
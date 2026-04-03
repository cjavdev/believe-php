<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\Conflicts\ConflictResolveResponse;
use Believe\Conflicts\ConflictResolveParams\ConflictType;
use Believe\Core\Exceptions\APIException;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface ConflictsContract{

    /**
  * @api
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
    ): ConflictResolveResponse;

}
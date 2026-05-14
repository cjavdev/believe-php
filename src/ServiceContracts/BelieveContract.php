<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\Believe\BelieveSubmitParams\SituationType;
use Believe\Believe\BelieveSubmitResponse;
use Believe\Core\Exceptions\APIException;
use Believe\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
interface BelieveContract
{
    /**
     * @api
     *
     * @param string $situation Describe your situation
     * @param SituationType|value-of<SituationType> $situationType Type of situation
     * @param string|null $context Additional context
     * @param int $intensity How intense is the response needed (1=gentle, 10=full Ted)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        string $situation,
        SituationType|string $situationType,
        ?string $context = null,
        int $intensity = 5,
        RequestOptions|array|null $requestOptions = null,
    ): BelieveSubmitResponse;
}

<?php

declare(strict_types=1);

namespace Believe\Quotes;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Get a paginated list of quotes related to a specific theme.
 *
 * @see Believe\Services\QuotesService::listByTheme()
 *
 * @phpstan-type QuoteListByThemeParamsShape = array{
 *   limit?: int|null, skip?: int|null
 * }
 */
final class QuoteListByThemeParams implements BaseModel
{
    /** @use SdkModel<QuoteListByThemeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Maximum number of items to return (max: 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Number of items to skip (offset).
     */
    #[Optional]
    public ?int $skip;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $limit = null, ?int $skip = null): self
    {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $skip && $self['skip'] = $skip;

        return $self;
    }

    /**
     * Maximum number of items to return (max: 100).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Number of items to skip (offset).
     */
    public function withSkip(int $skip): self
    {
        $self = clone $this;
        $self['skip'] = $skip;

        return $self;
    }
}

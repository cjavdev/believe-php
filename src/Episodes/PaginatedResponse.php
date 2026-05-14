<?php

declare(strict_types=1);

namespace Believe\Episodes;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type EpisodeShape from \Believe\Episodes\Episode
 *
 * @phpstan-type PaginatedResponseShape = array{
 *   data: list<Episode|EpisodeShape>,
 *   hasMore: bool,
 *   limit: int,
 *   page: int,
 *   pages: int,
 *   skip: int,
 *   total: int,
 * }
 */
final class PaginatedResponse implements BaseModel
{
    /** @use SdkModel<PaginatedResponseShape> */
    use SdkModel;

    /** @var list<Episode> $data */
    #[Required(list: Episode::class)]
    public array $data;

    /**
     * Whether there are more items after this page.
     */
    #[Required('has_more')]
    public bool $hasMore;

    #[Required]
    public int $limit;

    /**
     * Current page number (1-indexed, for display purposes).
     */
    #[Required]
    public int $page;

    /**
     * Total number of pages.
     */
    #[Required]
    public int $pages;

    #[Required]
    public int $skip;

    #[Required]
    public int $total;

    /**
     * `new PaginatedResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaginatedResponse::with(
     *   data: ...,
     *   hasMore: ...,
     *   limit: ...,
     *   page: ...,
     *   pages: ...,
     *   skip: ...,
     *   total: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaginatedResponse)
     *   ->withData(...)
     *   ->withHasMore(...)
     *   ->withLimit(...)
     *   ->withPage(...)
     *   ->withPages(...)
     *   ->withSkip(...)
     *   ->withTotal(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Episode|EpisodeShape> $data
     */
    public static function with(
        array $data,
        bool $hasMore,
        int $limit,
        int $page,
        int $pages,
        int $skip,
        int $total,
    ): self {
        $self = new self;

        $self['data'] = $data;
        $self['hasMore'] = $hasMore;
        $self['limit'] = $limit;
        $self['page'] = $page;
        $self['pages'] = $pages;
        $self['skip'] = $skip;
        $self['total'] = $total;

        return $self;
    }

    /**
     * @param list<Episode|EpisodeShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Whether there are more items after this page.
     */
    public function withHasMore(bool $hasMore): self
    {
        $self = clone $this;
        $self['hasMore'] = $hasMore;

        return $self;
    }

    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Current page number (1-indexed, for display purposes).
     */
    public function withPage(int $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    /**
     * Total number of pages.
     */
    public function withPages(int $pages): self
    {
        $self = clone $this;
        $self['pages'] = $pages;

        return $self;
    }

    public function withSkip(int $skip): self
    {
        $self = clone $this;
        $self['skip'] = $skip;

        return $self;
    }

    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }
}

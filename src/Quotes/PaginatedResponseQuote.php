<?php

declare(strict_types=1);

namespace Believe\Quotes;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * @phpstan-import-type QuoteShape from \Believe\Quotes\Quote
  * @phpstan-type PaginatedResponseQuoteShape = array{
  *   data: list<Quote|QuoteShape>,
  *   hasMore: bool,
  *   limit: int,
  *   page: int,
  *   pages: int,
  *   skip: int,
  *   total: int,
  * }
  *
 */
final class PaginatedResponseQuote implements BaseModel
{
  /** @use SdkModel<PaginatedResponseQuoteShape> */
  use SdkModel;

  /** @var list<Quote> $data */
  #[Required(list: Quote::class)]
  public array $data;

  /**
  * Whether there are more items after this page.
  *
  * @var bool $hasMore
 */
  #[Required('has_more')]
  public bool $hasMore;

  /** @var int $limit */
  #[Required]
  public int $limit;

  /**
  * Current page number (1-indexed, for display purposes).
  *
  * @var int $page
 */
  #[Required]
  public int $page;

  /**
  * Total number of pages.
  *
  * @var int $pages
 */
  #[Required]
  public int $pages;

  /** @var int $skip */
  #[Required]
  public int $skip;

  /** @var int $total */
  #[Required]
  public int $total;

  /**
  * `new PaginatedResponseQuote()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * PaginatedResponseQuote::with(
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
  * (new PaginatedResponseQuote)
  *   ->withData(...)
  *   ->withHasMore(...)
  *   ->withLimit(...)
  *   ->withPage(...)
  *   ->withPages(...)
  *   ->withSkip(...)
  *   ->withTotal(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param list<Quote|QuoteShape> $data
  * @param bool $hasMore
  * @param int $limit
  * @param int $page
  * @param int $pages
  * @param int $skip
  * @param int $total
  *
  * @return self
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
  * @param list<Quote|QuoteShape> $data
  *
  * @return self
 */
  public function withData(array $data): self {
    $self = clone $this;
    $self['data'] = $data;
    return $self;
  }

  /**
  * Whether there are more items after this page.
  *
  * @param bool $hasMore
  *
  * @return self
 */
  public function withHasMore(bool $hasMore): self {
    $self = clone $this;
    $self['hasMore'] = $hasMore;
    return $self;
  }

  /**
  * @param int $limit
  *
  * @return self
 */
  public function withLimit(int $limit): self {
    $self = clone $this;
    $self['limit'] = $limit;
    return $self;
  }

  /**
  * Current page number (1-indexed, for display purposes).
  *
  * @param int $page
  *
  * @return self
 */
  public function withPage(int $page): self {
    $self = clone $this;
    $self['page'] = $page;
    return $self;
  }

  /**
  * Total number of pages.
  *
  * @param int $pages
  *
  * @return self
 */
  public function withPages(int $pages): self {
    $self = clone $this;
    $self['pages'] = $pages;
    return $self;
  }

  /**
  * @param int $skip
  *
  * @return self
 */
  public function withSkip(int $skip): self {
    $self = clone $this;
    $self['skip'] = $skip;
    return $self;
  }

  /**
  * @param int $total
  *
  * @return self
 */
  public function withTotal(int $total): self {
    $self = clone $this;
    $self['total'] = $total;
    return $self;
  }
}
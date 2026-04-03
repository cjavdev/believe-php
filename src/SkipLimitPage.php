<?php

namespace Believe;

use Believe\Core\Conversion;
use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkPage;
use Believe\Core\Contracts\BaseModel;
use Believe\Core\Contracts\BasePage;
use Believe\Core\Conversion\ListOf;
use Believe\Core\Conversion\Contracts\Converter;
use Believe\Core\Conversion\Contracts\ConverterSource;
use Psr\Http\Message\ResponseInterface;

/**
  *
  * @phpstan-type SkipLimitPageShape = array{
  *   data?: list<mixed>|null, total?: int|null, skip?: int|null
  * }
  * @template TItem
  * @implements BasePage<TItem>
  *
 */
final class SkipLimitPage implements BaseModel, BasePage
{
  /** @use SdkModel<SkipLimitPageShape> */
  use SdkModel;

  /** @use SdkPage<TItem> */
  use SdkPage;

  /** @var list<TItem>|null $data */
  #[Optional(list: 'mixed')]
  public ?array $data;

  /** @var int|null $total */
  #[Optional]
  public ?int $total;

  /** @var int|null $skip */
  #[Optional]
  public ?int $skip;

  /** @return list<TItem> */
  function getItems(): array {
    // @phpstan-ignore-next-line return.type
    return $this->offsetGet('data') ?? [];
  }

  /**
  * @internal
  *
  * @return array{
  *   array{
  *     method: string,
  *     path: string,
  *     query: array<string,mixed>,
  *     headers: array<string,string|null|list<string>>,
  *     body: mixed,
  *   },
  *   RequestOptions,
  * }|null
 */
  function nextRequest(): ?array {
    $items = $this->getItems();
    // @phpstan-ignore-next-line binaryOp.invalid
    $curr = ($this->skip ?? 0) + ($cnt = count($items));
    if (!$cnt||($curr >= ($this->total ?? null))) {
      return null;

    }

    $nextRequest = array_merge_recursive(
      $this->requestInfo, ['query' => ['skip' => $curr]]
    );

    // @phpstan-ignore-next-line return.type
    return [$nextRequest, $this->options];
  }

  /**
  * @internal
  *
  * @param string|Converter|ConverterSource $convert
  * @param Client $client
  * @param array{
  *   method: string,
  *   path: string,
  *   query: array<string,mixed>,
  *   headers: array<string,string|null|list<string>>,
  *   body: mixed,
  * } $requestInfo
  * @param RequestOptions $options
  * @param mixed $parsedBody
 */
  function __construct(
    private string|Converter|ConverterSource $convert,
    private Client $client,
    private array $requestInfo,
    private RequestOptions $options,
    private ResponseInterface $response,
    private mixed $parsedBody,
  ) {
    $this->initialize();

    if (!is_array($this->parsedBody)) {
      return;

    }

    // @phpstan-ignore-next-line argument.type
    self::__unserialize($this->parsedBody);

    if (is_array($items = $this->offsetGet('data'))) {
      $parsed = Conversion::coerce(new ListOf($convert), value: $items);
      // @phpstan-ignore-next-line
      $this->offsetSet('data', value: $parsed);

    }
  }
}
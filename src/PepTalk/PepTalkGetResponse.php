<?php

declare(strict_types=1);

namespace Believe\PepTalk;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\PepTalk\PepTalkGetResponse\Chunk;

/**
  * A complete pep talk response.
  * @phpstan-import-type ChunkShape from \Believe\PepTalk\PepTalkGetResponse\Chunk
  * @phpstan-type PepTalkGetResponseShape = array{
  *   chunks: list<Chunk|ChunkShape>, text: string
  * }
  *
 */
final class PepTalkGetResponse implements BaseModel
{
  /** @use SdkModel<PepTalkGetResponseShape> */
  use SdkModel;

  /**
  * Individual chunks of the pep talk
  *
  * @var list<Chunk> $chunks
 */
  #[Required(list: Chunk::class)]
  public array $chunks;

  /**
  * The full pep talk text
  *
  * @var string $text
 */
  #[Required]
  public string $text;

  /**
  * `new PepTalkGetResponse()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * PepTalkGetResponse::with(chunks: ..., text: ...)
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new PepTalkGetResponse)->withChunks(...)->withText(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param list<Chunk|ChunkShape> $chunks
  * @param string $text
  *
  * @return self
 */
  public static function with(array $chunks, string $text): self {
    $self = new self;

    $self['chunks'] = $chunks;
    $self['text'] = $text;

    return $self;
  }

  /**
  * Individual chunks of the pep talk
  *
  * @param list<Chunk|ChunkShape> $chunks
  *
  * @return self
 */
  public function withChunks(array $chunks): self {
    $self = clone $this;
    $self['chunks'] = $chunks;
    return $self;
  }

  /**
  * The full pep talk text
  *
  * @param string $text
  *
  * @return self
 */
  public function withText(string $text): self {
    $self = clone $this;
    $self['text'] = $text;
    return $self;
  }
}
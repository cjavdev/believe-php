<?php

declare(strict_types=1);

namespace Believe\Biscuits;

use Believe\Biscuits\Biscuit\Type;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * A biscuit from Ted.
  *
  * @phpstan-type BiscuitShape = array{
  *   id: string,
  *   message: string,
  *   pairsWellWith: string,
  *   tedNote: string,
  *   type: Type|value-of<Type>,
  *   warmthLevel: int,
  * }
  *
 */
final class Biscuit implements BaseModel
{
  /** @use SdkModel<BiscuitShape> */
  use SdkModel;

  /**
  * Biscuit identifier
  *
  * @var string $id
 */
  #[Required]
  public string $id;

  /**
  * Message that comes with the biscuit
  *
  * @var string $message
 */
  #[Required]
  public string $message;

  /**
  * What this biscuit pairs well with
  *
  * @var string $pairsWellWith
 */
  #[Required('pairs_well_with')]
  public string $pairsWellWith;

  /**
  * A handwritten note from Ted
  *
  * @var string $tedNote
 */
  #[Required('ted_note')]
  public string $tedNote;

  /**
  * Type of biscuit
  *
  * @var value-of<Type> $type
 */
  #[Required(enum: Type::class)]
  public string $type;

  /**
  * How warm and fresh (1-10)
  *
  * @var int $warmthLevel
 */
  #[Required('warmth_level')]
  public int $warmthLevel;

  /**
  * `new Biscuit()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * Biscuit::with(
  *   id: ...,
  *   message: ...,
  *   pairsWellWith: ...,
  *   tedNote: ...,
  *   type: ...,
  *   warmthLevel: ...,
  * )
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new Biscuit)
  *   ->withID(...)
  *   ->withMessage(...)
  *   ->withPairsWellWith(...)
  *   ->withTedNote(...)
  *   ->withType(...)
  *   ->withWarmthLevel(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $id
  * @param string $message
  * @param string $pairsWellWith
  * @param string $tedNote
  * @param Type|value-of<Type> $type
  * @param int $warmthLevel
  *
  * @return self
 */
  public static function with(
    string $id,
    string $message,
    string $pairsWellWith,
    string $tedNote,
    Type|string $type,
    int $warmthLevel,
  ): self {
    $self = new self;

    $self['id'] = $id;
    $self['message'] = $message;
    $self['pairsWellWith'] = $pairsWellWith;
    $self['tedNote'] = $tedNote;
    $self['type'] = $type;
    $self['warmthLevel'] = $warmthLevel;

    return $self;
  }

  /**
  * Biscuit identifier
  *
  * @param string $id
  *
  * @return self
 */
  public function withID(string $id): self {
    $self = clone $this;
    $self['id'] = $id;
    return $self;
  }

  /**
  * Message that comes with the biscuit
  *
  * @param string $message
  *
  * @return self
 */
  public function withMessage(string $message): self {
    $self = clone $this;
    $self['message'] = $message;
    return $self;
  }

  /**
  * What this biscuit pairs well with
  *
  * @param string $pairsWellWith
  *
  * @return self
 */
  public function withPairsWellWith(string $pairsWellWith): self {
    $self = clone $this;
    $self['pairsWellWith'] = $pairsWellWith;
    return $self;
  }

  /**
  * A handwritten note from Ted
  *
  * @param string $tedNote
  *
  * @return self
 */
  public function withTedNote(string $tedNote): self {
    $self = clone $this;
    $self['tedNote'] = $tedNote;
    return $self;
  }

  /**
  * Type of biscuit
  *
  * @param Type|value-of<Type> $type
  *
  * @return self
 */
  public function withType(Type|string $type): self {
    $self = clone $this;
    $self['type'] = $type;
    return $self;
  }

  /**
  * How warm and fresh (1-10)
  *
  * @param int $warmthLevel
  *
  * @return self
 */
  public function withWarmthLevel(int $warmthLevel): self {
    $self = clone $this;
    $self['warmthLevel'] = $warmthLevel;
    return $self;
  }
}
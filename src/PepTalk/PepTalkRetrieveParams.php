<?php

declare(strict_types=1);

namespace Believe\PepTalk;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Get a motivational pep talk from Ted Lasso himself. By default returns the complete pep talk. Add `?stream=true` to get Server-Sent Events (SSE) streaming the pep talk chunk by chunk.
  * @see Believe\Services\PepTalkService::retrieve()
  *
  * @phpstan-type PepTalkRetrieveParamsShape = array{stream?: bool|null}
  *
 */
final class PepTalkRetrieveParams implements BaseModel
{
  /** @use SdkModel<PepTalkRetrieveParamsShape> */
  use SdkModel;
  use SdkParams;

  /**
  * If true, returns SSE stream instead of full response
  *
  * @var bool|null $stream
 */
  #[Optional]
  public ?bool $stream;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param bool|null $stream
  *
  * @return self
 */
  public static function with(bool $stream = null): self {
    $self = new self;

    null !== $stream && $self['stream'] = $stream;

    return $self;
  }

  /**
  * If true, returns SSE stream instead of full response
  *
  * @param bool $stream
  *
  * @return self
 */
  public function withStream(bool $stream): self {
    $self = clone $this;
    $self['stream'] = $stream;
    return $self;
  }
}
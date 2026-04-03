<?php

declare(strict_types=1);

namespace Believe\Teams\Logo;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Delete a team's logo.
  * @see Believe\Services\Teams\LogoService::delete()
  *
  * @phpstan-type LogoDeleteParamsShape = array{teamID: string}
  *
 */
final class LogoDeleteParams implements BaseModel
{
  /** @use SdkModel<LogoDeleteParamsShape> */
  use SdkModel;
  use SdkParams;

  /** @var string $teamID */
  #[Required]
  public string $teamID;

  /**
  * `new LogoDeleteParams()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * LogoDeleteParams::with(teamID: ...)
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new LogoDeleteParams)->withTeamID(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $teamID
  *
  * @return self
 */
  public static function with(string $teamID): self {
    $self = new self;

    $self['teamID'] = $teamID;

    return $self;
  }

  /**
  * @param string $teamID
  *
  * @return self
 */
  public function withTeamID(string $teamID): self {
    $self = clone $this;
    $self['teamID'] = $teamID;
    return $self;
  }
}
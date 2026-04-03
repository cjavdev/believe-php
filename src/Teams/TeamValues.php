<?php

declare(strict_types=1);

namespace Believe\Teams;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Core values that define a team's culture.
  *
  * @phpstan-type TeamValuesShape = array{
  *   primaryValue: string, secondaryValues: list<string>, teamMotto: string
  * }
  *
 */
final class TeamValues implements BaseModel
{
  /** @use SdkModel<TeamValuesShape> */
  use SdkModel;

  /**
  * The team's primary guiding value
  *
  * @var string $primaryValue
 */
  #[Required('primary_value')]
  public string $primaryValue;

  /**
  * Supporting values
  *
  * @var list<string> $secondaryValues
 */
  #[Required('secondary_values', list: 'string')]
  public array $secondaryValues;

  /**
  * Team's motivational motto
  *
  * @var string $teamMotto
 */
  #[Required('team_motto')]
  public string $teamMotto;

  /**
  * `new TeamValues()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * TeamValues::with(primaryValue: ..., secondaryValues: ..., teamMotto: ...)
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new TeamValues)
  *   ->withPrimaryValue(...)
  *   ->withSecondaryValues(...)
  *   ->withTeamMotto(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $primaryValue
  * @param list<string> $secondaryValues
  * @param string $teamMotto
  *
  * @return self
 */
  public static function with(
    string $primaryValue, array $secondaryValues, string $teamMotto
  ): self {
    $self = new self;

    $self['primaryValue'] = $primaryValue;
    $self['secondaryValues'] = $secondaryValues;
    $self['teamMotto'] = $teamMotto;

    return $self;
  }

  /**
  * The team's primary guiding value
  *
  * @param string $primaryValue
  *
  * @return self
 */
  public function withPrimaryValue(string $primaryValue): self {
    $self = clone $this;
    $self['primaryValue'] = $primaryValue;
    return $self;
  }

  /**
  * Supporting values
  *
  * @param list<string> $secondaryValues
  *
  * @return self
 */
  public function withSecondaryValues(array $secondaryValues): self {
    $self = clone $this;
    $self['secondaryValues'] = $secondaryValues;
    return $self;
  }

  /**
  * Team's motivational motto
  *
  * @param string $teamMotto
  *
  * @return self
 */
  public function withTeamMotto(string $teamMotto): self {
    $self = clone $this;
    $self['teamMotto'] = $teamMotto;
    return $self;
  }
}
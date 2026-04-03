<?php

declare(strict_types=1);

namespace Believe\TeamMembers\TeamMemberUpdateParams\Updates;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Update model for equipment managers.
  *
  * @phpstan-type EquipmentManagerUpdateShape = array{
  *   isHeadKitman?: bool|null,
  *   responsibilities?: list<string>|null,
  *   teamID?: string|null,
  *   yearsWithTeam?: int|null,
  * }
  *
 */
final class EquipmentManagerUpdate implements BaseModel
{
  /** @use SdkModel<EquipmentManagerUpdateShape> */
  use SdkModel;

  /** @var bool|null $isHeadKitman */
  #[Optional('is_head_kitman', nullable: true)]
  public ?bool $isHeadKitman;

  /** @var list<string>|null $responsibilities */
  #[Optional(list: 'string', nullable: true)]
  public ?array $responsibilities;

  /** @var string|null $teamID */
  #[Optional('team_id', nullable: true)]
  public ?string $teamID;

  /** @var int|null $yearsWithTeam */
  #[Optional('years_with_team', nullable: true)]
  public ?int $yearsWithTeam;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param bool|null $isHeadKitman
  * @param list<string>|null $responsibilities
  * @param string|null $teamID
  * @param int|null $yearsWithTeam
  *
  * @return self
 */
  public static function with(
    ?bool $isHeadKitman = null,
    ?array $responsibilities = null,
    ?string $teamID = null,
    ?int $yearsWithTeam = null,
  ): self {
    $self = new self;

    null !== $isHeadKitman && $self['isHeadKitman'] = $isHeadKitman;
    null !== $responsibilities && $self['responsibilities'] = $responsibilities;
    null !== $teamID && $self['teamID'] = $teamID;
    null !== $yearsWithTeam && $self['yearsWithTeam'] = $yearsWithTeam;

    return $self;
  }

  /**
  * @param bool|null $isHeadKitman
  *
  * @return self
 */
  public function withIsHeadKitman(?bool $isHeadKitman): self {
    $self = clone $this;
    $self['isHeadKitman'] = $isHeadKitman;
    return $self;
  }

  /**
  * @param list<string>|null $responsibilities
  *
  * @return self
 */
  public function withResponsibilities(?array $responsibilities): self {
    $self = clone $this;
    $self['responsibilities'] = $responsibilities;
    return $self;
  }

  /**
  * @param string|null $teamID
  *
  * @return self
 */
  public function withTeamID(?string $teamID): self {
    $self = clone $this;
    $self['teamID'] = $teamID;
    return $self;
  }

  /**
  * @param int|null $yearsWithTeam
  *
  * @return self
 */
  public function withYearsWithTeam(?int $yearsWithTeam): self {
    $self = clone $this;
    $self['yearsWithTeam'] = $yearsWithTeam;
    return $self;
  }
}
<?php

declare(strict_types=1);

namespace Believe\TeamMembers;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\PlayerUpdate;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\CoachUpdate;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\MedicalStaffUpdate;
use Believe\TeamMembers\TeamMemberUpdateParams\Updates\EquipmentManagerUpdate;

/**
  * Update specific fields of an existing team member. Fields vary by member type.
  * @see Believe\Services\TeamMembersService::update()
  * @phpstan-import-type UpdatesVariants from \Believe\TeamMembers\TeamMemberUpdateParams\Updates
  * @phpstan-import-type UpdatesShape from \Believe\TeamMembers\TeamMemberUpdateParams\Updates
  * @phpstan-type TeamMemberUpdateParamsShape = array{updates: UpdatesShape}
  *
 */
final class TeamMemberUpdateParams implements BaseModel
{
  /** @use SdkModel<TeamMemberUpdateParamsShape> */
  use SdkModel;
  use SdkParams;

  /**
  * Update model for players.
  *
  * @var UpdatesVariants $updates
 */
  #[Required]
  public PlayerUpdate|CoachUpdate|MedicalStaffUpdate|EquipmentManagerUpdate $updates;

  /**
  * `new TeamMemberUpdateParams()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * TeamMemberUpdateParams::with(updates: ...)
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new TeamMemberUpdateParams)->withUpdates(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param UpdatesShape $updates
  *
  * @return self
 */
  public static function with(
    PlayerUpdate|array|CoachUpdate|MedicalStaffUpdate|EquipmentManagerUpdate $updates,
  ): self {
    $self = new self;

    $self['updates'] = $updates;

    return $self;
  }

  /**
  * Update model for players.
  *
  * @param UpdatesShape $updates
  *
  * @return self
 */
  public function withUpdates(
    PlayerUpdate|array|CoachUpdate|MedicalStaffUpdate|EquipmentManagerUpdate $updates,
  ): self {
    $self = clone $this;
    $self['updates'] = $updates;
    return $self;
  }
}
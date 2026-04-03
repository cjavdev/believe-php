<?php

declare(strict_types=1);

namespace Believe\TeamMembers;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\TeamMembers\TeamMemberListParams\MemberType;

/**
  * Get a paginated list of all team members.
  *
  * This endpoint demonstrates **union types (oneOf)** in the response.
  * Each team member can be one of: Player, Coach, MedicalStaff, or EquipmentManager.
  * The `member_type` field acts as a discriminator to determine the shape of each object.
  * @see Believe\Services\TeamMembersService::list()
  *
  * @phpstan-type TeamMemberListParamsShape = array{
  *   limit?: int|null,
  *   memberType?: null|MemberType|value-of<MemberType>,
  *   skip?: int|null,
  *   teamID?: string|null,
  * }
  *
 */
final class TeamMemberListParams implements BaseModel
{
  /** @use SdkModel<TeamMemberListParamsShape> */
  use SdkModel;
  use SdkParams;

  /**
  * Maximum number of items to return (max: 100)
  *
  * @var int|null $limit
 */
  #[Optional]
  public ?int $limit;

  /**
  * Filter by member type
  *
  * @var value-of<MemberType>|null $memberType
 */
  #[Optional(enum: MemberType::class, nullable: true)]
  public ?string $memberType;

  /**
  * Number of items to skip (offset)
  *
  * @var int|null $skip
 */
  #[Optional]
  public ?int $skip;

  /**
  * Filter by team ID
  *
  * @var string|null $teamID
 */
  #[Optional(nullable: true)]
  public ?string $teamID;

  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param int|null $limit
  * @param null|MemberType|value-of<MemberType> $memberType
  * @param int|null $skip
  * @param string|null $teamID
  *
  * @return self
 */
  public static function with(
    int $limit = null,
    null|MemberType|string $memberType = null,
    int $skip = null,
    ?string $teamID = null,
  ): self {
    $self = new self;

    null !== $limit && $self['limit'] = $limit;
    null !== $memberType && $self['memberType'] = $memberType;
    null !== $skip && $self['skip'] = $skip;
    null !== $teamID && $self['teamID'] = $teamID;

    return $self;
  }

  /**
  * Maximum number of items to return (max: 100)
  *
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
  * Filter by member type
  *
  * @param null|MemberType|value-of<MemberType> $memberType
  *
  * @return self
 */
  public function withMemberType(null|MemberType|string $memberType): self {
    $self = clone $this;
    $self['memberType'] = $memberType;
    return $self;
  }

  /**
  * Number of items to skip (offset)
  *
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
  * Filter by team ID
  *
  * @param string|null $teamID
  *
  * @return self
 */
  public function withTeamID(?string $teamID): self {
    $self = clone $this;
    $self['teamID'] = $teamID;
    return $self;
  }
}
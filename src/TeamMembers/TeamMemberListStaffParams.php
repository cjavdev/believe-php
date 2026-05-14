<?php

declare(strict_types=1);

namespace Believe\TeamMembers;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Get all staff members (medical staff and equipment managers).
 *
 * This demonstrates a **narrower union type** - the response is oneOf MedicalStaff or EquipmentManager.
 *
 * @see Believe\Services\TeamMembersService::listStaff()
 *
 * @phpstan-type TeamMemberListStaffParamsShape = array{
 *   limit?: int|null, skip?: int|null, teamID?: string|null
 * }
 */
final class TeamMemberListStaffParams implements BaseModel
{
    /** @use SdkModel<TeamMemberListStaffParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Maximum number of items to return (max: 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Number of items to skip (offset).
     */
    #[Optional]
    public ?int $skip;

    /**
     * Filter by team ID.
     */
    #[Optional(nullable: true)]
    public ?string $teamID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?int $limit = null,
        ?int $skip = null,
        ?string $teamID = null
    ): self {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $skip && $self['skip'] = $skip;
        null !== $teamID && $self['teamID'] = $teamID;

        return $self;
    }

    /**
     * Maximum number of items to return (max: 100).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Number of items to skip (offset).
     */
    public function withSkip(int $skip): self
    {
        $self = clone $this;
        $self['skip'] = $skip;

        return $self;
    }

    /**
     * Filter by team ID.
     */
    public function withTeamID(?string $teamID): self
    {
        $self = clone $this;
        $self['teamID'] = $teamID;

        return $self;
    }
}

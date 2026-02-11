<?php

declare(strict_types=1);

namespace Believe\TeamMembers;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;
use Believe\TeamMembers\TeamMemberCreateParams\Member;
use Believe\TeamMembers\TeamMemberCreateParams\Member\CoachBase;
use Believe\TeamMembers\TeamMemberCreateParams\Member\EquipmentManagerBase;
use Believe\TeamMembers\TeamMemberCreateParams\Member\MedicalStaffBase;
use Believe\TeamMembers\TeamMemberCreateParams\Member\PlayerBase;

/**
 * Add a new team member to a team.
 *
 * The request body is a **union type (oneOf)** - you must include the `member_type` discriminator field:
 * - `"member_type": "player"` - Creates a player (requires position, jersey_number, etc.)
 * - `"member_type": "coach"` - Creates a coach (requires specialty, etc.)
 * - `"member_type": "medical_staff"` - Creates medical staff (requires medical specialty, etc.)
 * - `"member_type": "equipment_manager"` - Creates equipment manager (requires responsibilities, etc.)
 *
 * The `character_id` field references an existing character from `/characters/{id}`.
 *
 * **Example for creating a player:**
 * ```json
 * {
 *   "member_type": "player",
 *   "character_id": "sam-obisanya",
 *   "team_id": "afc-richmond",
 *   "years_with_team": 2,
 *   "position": "midfielder",
 *   "jersey_number": 24,
 *   "goals_scored": 12,
 *   "assists": 15
 * }
 * ```
 *
 * @see Believe\Services\TeamMembersService::create()
 *
 * @phpstan-import-type MemberVariants from \Believe\TeamMembers\TeamMemberCreateParams\Member
 * @phpstan-import-type MemberShape from \Believe\TeamMembers\TeamMemberCreateParams\Member
 *
 * @phpstan-type TeamMemberCreateParamsShape = array{member: MemberShape}
 */
final class TeamMemberCreateParams implements BaseModel
{
    /** @use SdkModel<TeamMemberCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A football player on the team.
     *
     * @var MemberVariants $member
     */
    #[Required(union: Member::class)]
    public PlayerBase|CoachBase|MedicalStaffBase|EquipmentManagerBase $member;

    /**
     * `new TeamMemberCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TeamMemberCreateParams::with(member: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TeamMemberCreateParams)->withMember(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param MemberShape $member
     */
    public static function with(
        PlayerBase|array|CoachBase|MedicalStaffBase|EquipmentManagerBase $member
    ): self {
        $self = new self;

        $self['member'] = $member;

        return $self;
    }

    /**
     * A football player on the team.
     *
     * @param MemberShape $member
     */
    public function withMember(
        PlayerBase|array|CoachBase|MedicalStaffBase|EquipmentManagerBase $member
    ): self {
        $self = clone $this;
        $self['member'] = $member;

        return $self;
    }
}

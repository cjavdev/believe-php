<?php

declare(strict_types=1);

namespace Believe\TeamMembers\TeamMemberCreateParams\Member;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\TeamMembers\TeamMemberCreateParams\Member\EquipmentManagerBase\MemberType;

/**
 * Equipment and kit management staff.
 *
 * @phpstan-type EquipmentManagerBaseShape = array{
 *   characterID: string,
 *   teamID: string,
 *   yearsWithTeam: int,
 *   isHeadKitman?: bool|null,
 *   memberType?: null|MemberType|value-of<MemberType>,
 *   responsibilities?: list<string>|null,
 * }
 */
final class EquipmentManagerBase implements BaseModel
{
    /** @use SdkModel<EquipmentManagerBaseShape> */
    use SdkModel;

    /**
     * ID of the character (references /characters/{id}).
     */
    #[Required('character_id')]
    public string $characterID;

    /**
     * ID of the team they belong to.
     */
    #[Required('team_id')]
    public string $teamID;

    /**
     * Number of years with the current team.
     */
    #[Required('years_with_team')]
    public int $yearsWithTeam;

    /**
     * Whether this is the head equipment manager.
     */
    #[Optional('is_head_kitman')]
    public ?bool $isHeadKitman;

    /**
     * Discriminator field indicating this is an equipment manager.
     *
     * @var value-of<MemberType>|null $memberType
     */
    #[Optional('member_type', enum: MemberType::class)]
    public ?string $memberType;

    /**
     * List of responsibilities.
     *
     * @var list<string>|null $responsibilities
     */
    #[Optional(list: 'string')]
    public ?array $responsibilities;

    /**
     * `new EquipmentManagerBase()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EquipmentManagerBase::with(characterID: ..., teamID: ..., yearsWithTeam: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EquipmentManagerBase)
     *   ->withCharacterID(...)
     *   ->withTeamID(...)
     *   ->withYearsWithTeam(...)
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
     * @param MemberType|value-of<MemberType>|null $memberType
     * @param list<string>|null $responsibilities
     */
    public static function with(
        string $characterID,
        string $teamID,
        int $yearsWithTeam,
        ?bool $isHeadKitman = null,
        MemberType|string|null $memberType = null,
        ?array $responsibilities = null,
    ): self {
        $self = new self;

        $self['characterID'] = $characterID;
        $self['teamID'] = $teamID;
        $self['yearsWithTeam'] = $yearsWithTeam;

        null !== $isHeadKitman && $self['isHeadKitman'] = $isHeadKitman;
        null !== $memberType && $self['memberType'] = $memberType;
        null !== $responsibilities && $self['responsibilities'] = $responsibilities;

        return $self;
    }

    /**
     * ID of the character (references /characters/{id}).
     */
    public function withCharacterID(string $characterID): self
    {
        $self = clone $this;
        $self['characterID'] = $characterID;

        return $self;
    }

    /**
     * ID of the team they belong to.
     */
    public function withTeamID(string $teamID): self
    {
        $self = clone $this;
        $self['teamID'] = $teamID;

        return $self;
    }

    /**
     * Number of years with the current team.
     */
    public function withYearsWithTeam(int $yearsWithTeam): self
    {
        $self = clone $this;
        $self['yearsWithTeam'] = $yearsWithTeam;

        return $self;
    }

    /**
     * Whether this is the head equipment manager.
     */
    public function withIsHeadKitman(bool $isHeadKitman): self
    {
        $self = clone $this;
        $self['isHeadKitman'] = $isHeadKitman;

        return $self;
    }

    /**
     * Discriminator field indicating this is an equipment manager.
     *
     * @param MemberType|value-of<MemberType> $memberType
     */
    public function withMemberType(MemberType|string $memberType): self
    {
        $self = clone $this;
        $self['memberType'] = $memberType;

        return $self;
    }

    /**
     * List of responsibilities.
     *
     * @param list<string> $responsibilities
     */
    public function withResponsibilities(array $responsibilities): self
    {
        $self = clone $this;
        $self['responsibilities'] = $responsibilities;

        return $self;
    }
}

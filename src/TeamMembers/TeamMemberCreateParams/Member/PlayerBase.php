<?php

declare(strict_types=1);

namespace Believe\TeamMembers\TeamMemberCreateParams\Member;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\TeamMembers\Position;
use Believe\TeamMembers\TeamMemberCreateParams\Member\PlayerBase\MemberType;

/**
 * A football player on the team.
 *
 * @phpstan-type PlayerBaseShape = array{
 *   characterID: string,
 *   jerseyNumber: int,
 *   position: Position|value-of<Position>,
 *   teamID: string,
 *   yearsWithTeam: int,
 *   assists?: int|null,
 *   goalsScored?: int|null,
 *   isCaptain?: bool|null,
 *   memberType?: null|MemberType|value-of<MemberType>,
 * }
 */
final class PlayerBase implements BaseModel
{
    /** @use SdkModel<PlayerBaseShape> */
    use SdkModel;

    /**
     * ID of the character (references /characters/{id}).
     */
    #[Required('character_id')]
    public string $characterID;

    /**
     * Jersey/shirt number.
     */
    #[Required('jersey_number')]
    public int $jerseyNumber;

    /**
     * Playing position on the field.
     *
     * @var value-of<Position> $position
     */
    #[Required(enum: Position::class)]
    public string $position;

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
     * Total assists for the team.
     */
    #[Optional]
    public ?int $assists;

    /**
     * Total goals scored for the team.
     */
    #[Optional('goals_scored')]
    public ?int $goalsScored;

    /**
     * Whether this player is team captain.
     */
    #[Optional('is_captain')]
    public ?bool $isCaptain;

    /**
     * Discriminator field indicating this is a player.
     *
     * @var value-of<MemberType>|null $memberType
     */
    #[Optional('member_type', enum: MemberType::class)]
    public ?string $memberType;

    /**
     * `new PlayerBase()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PlayerBase::with(
     *   characterID: ...,
     *   jerseyNumber: ...,
     *   position: ...,
     *   teamID: ...,
     *   yearsWithTeam: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PlayerBase)
     *   ->withCharacterID(...)
     *   ->withJerseyNumber(...)
     *   ->withPosition(...)
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
     * @param Position|value-of<Position> $position
     * @param MemberType|value-of<MemberType>|null $memberType
     */
    public static function with(
        string $characterID,
        int $jerseyNumber,
        Position|string $position,
        string $teamID,
        int $yearsWithTeam,
        ?int $assists = null,
        ?int $goalsScored = null,
        ?bool $isCaptain = null,
        MemberType|string|null $memberType = null,
    ): self {
        $self = new self;

        $self['characterID'] = $characterID;
        $self['jerseyNumber'] = $jerseyNumber;
        $self['position'] = $position;
        $self['teamID'] = $teamID;
        $self['yearsWithTeam'] = $yearsWithTeam;

        null !== $assists && $self['assists'] = $assists;
        null !== $goalsScored && $self['goalsScored'] = $goalsScored;
        null !== $isCaptain && $self['isCaptain'] = $isCaptain;
        null !== $memberType && $self['memberType'] = $memberType;

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
     * Jersey/shirt number.
     */
    public function withJerseyNumber(int $jerseyNumber): self
    {
        $self = clone $this;
        $self['jerseyNumber'] = $jerseyNumber;

        return $self;
    }

    /**
     * Playing position on the field.
     *
     * @param Position|value-of<Position> $position
     */
    public function withPosition(Position|string $position): self
    {
        $self = clone $this;
        $self['position'] = $position;

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
     * Total assists for the team.
     */
    public function withAssists(int $assists): self
    {
        $self = clone $this;
        $self['assists'] = $assists;

        return $self;
    }

    /**
     * Total goals scored for the team.
     */
    public function withGoalsScored(int $goalsScored): self
    {
        $self = clone $this;
        $self['goalsScored'] = $goalsScored;

        return $self;
    }

    /**
     * Whether this player is team captain.
     */
    public function withIsCaptain(bool $isCaptain): self
    {
        $self = clone $this;
        $self['isCaptain'] = $isCaptain;

        return $self;
    }

    /**
     * Discriminator field indicating this is a player.
     *
     * @param MemberType|value-of<MemberType> $memberType
     */
    public function withMemberType(MemberType|string $memberType): self
    {
        $self = clone $this;
        $self['memberType'] = $memberType;

        return $self;
    }
}

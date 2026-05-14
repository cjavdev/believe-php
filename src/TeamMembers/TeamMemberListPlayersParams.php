<?php

declare(strict_types=1);

namespace Believe\TeamMembers;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Get only players (filtered subset of team members).
 *
 * @see Believe\Services\TeamMembersService::listPlayers()
 *
 * @phpstan-type TeamMemberListPlayersParamsShape = array{
 *   limit?: int|null,
 *   position?: null|Position|value-of<Position>,
 *   skip?: int|null,
 *   teamID?: string|null,
 * }
 */
final class TeamMemberListPlayersParams implements BaseModel
{
    /** @use SdkModel<TeamMemberListPlayersParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Maximum number of items to return (max: 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter by position.
     *
     * @var value-of<Position>|null $position
     */
    #[Optional(enum: Position::class, nullable: true)]
    public ?string $position;

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
     *
     * @param Position|value-of<Position>|null $position
     */
    public static function with(
        ?int $limit = null,
        Position|string|null $position = null,
        ?int $skip = null,
        ?string $teamID = null,
    ): self {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $position && $self['position'] = $position;
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
     * Filter by position.
     *
     * @param Position|value-of<Position>|null $position
     */
    public function withPosition(Position|string|null $position): self
    {
        $self = clone $this;
        $self['position'] = $position;

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

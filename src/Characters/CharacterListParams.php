<?php

declare(strict_types=1);

namespace Believe\Characters;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Get a paginated list of Ted Lasso characters.
 *
 * @see Believe\Services\CharactersService::list()
 *
 * @phpstan-type CharacterListParamsShape = array{
 *   limit?: int|null,
 *   minOptimism?: int|null,
 *   role?: null|CharacterRole|value-of<CharacterRole>,
 *   skip?: int|null,
 *   teamID?: string|null,
 * }
 */
final class CharacterListParams implements BaseModel
{
    /** @use SdkModel<CharacterListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Maximum number of items to return (max: 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Minimum optimism score.
     */
    #[Optional(nullable: true)]
    public ?int $minOptimism;

    /**
     * Filter by role.
     *
     * @var value-of<CharacterRole>|null $role
     */
    #[Optional(enum: CharacterRole::class, nullable: true)]
    public ?string $role;

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
     * @param CharacterRole|value-of<CharacterRole>|null $role
     */
    public static function with(
        ?int $limit = null,
        ?int $minOptimism = null,
        CharacterRole|string|null $role = null,
        ?int $skip = null,
        ?string $teamID = null,
    ): self {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $minOptimism && $self['minOptimism'] = $minOptimism;
        null !== $role && $self['role'] = $role;
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
     * Minimum optimism score.
     */
    public function withMinOptimism(?int $minOptimism): self
    {
        $self = clone $this;
        $self['minOptimism'] = $minOptimism;

        return $self;
    }

    /**
     * Filter by role.
     *
     * @param CharacterRole|value-of<CharacterRole>|null $role
     */
    public function withRole(CharacterRole|string|null $role): self
    {
        $self = clone $this;
        $self['role'] = $role;

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

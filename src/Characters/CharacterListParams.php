<?php

declare(strict_types=1);

namespace Believe\Characters;

use Believe\Core\Attributes\Optional;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Get a paginated list of Ted Lasso characters.
  * @see Believe\Services\CharactersService::list()
  *
  * @phpstan-type CharacterListParamsShape = array{
  *   limit?: int|null,
  *   minOptimism?: int|null,
  *   role?: null|CharacterRole|value-of<CharacterRole>,
  *   skip?: int|null,
  *   teamID?: string|null,
  * }
  *
 */
final class CharacterListParams implements BaseModel
{
  /** @use SdkModel<CharacterListParamsShape> */
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
  * Minimum optimism score
  *
  * @var int|null $minOptimism
 */
  #[Optional(nullable: true)]
  public ?int $minOptimism;

  /**
  * Filter by role
  *
  * @var value-of<CharacterRole>|null $role
 */
  #[Optional(enum: CharacterRole::class, nullable: true)]
  public ?string $role;

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
  * @param int|null $minOptimism
  * @param null|CharacterRole|value-of<CharacterRole> $role
  * @param int|null $skip
  * @param string|null $teamID
  *
  * @return self
 */
  public static function with(
    int $limit = null,
    ?int $minOptimism = null,
    null|CharacterRole|string $role = null,
    int $skip = null,
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
  * Minimum optimism score
  *
  * @param int|null $minOptimism
  *
  * @return self
 */
  public function withMinOptimism(?int $minOptimism): self {
    $self = clone $this;
    $self['minOptimism'] = $minOptimism;
    return $self;
  }

  /**
  * Filter by role
  *
  * @param null|CharacterRole|value-of<CharacterRole> $role
  *
  * @return self
 */
  public function withRole(null|CharacterRole|string $role): self {
    $self = clone $this;
    $self['role'] = $role;
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
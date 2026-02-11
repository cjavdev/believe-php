<?php

declare(strict_types=1);

namespace Believe\Conflicts;

use Believe\Conflicts\ConflictResolveParams\ConflictType;
use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Get Ted Lasso-style advice for resolving conflicts.
 *
 * @see Believe\Services\ConflictsService::resolve()
 *
 * @phpstan-type ConflictResolveParamsShape = array{
 *   conflictType: ConflictType|value-of<ConflictType>,
 *   description: string,
 *   partiesInvolved: list<string>,
 *   attemptsMade?: list<string>|null,
 * }
 */
final class ConflictResolveParams implements BaseModel
{
    /** @use SdkModel<ConflictResolveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Type of conflict.
     *
     * @var value-of<ConflictType> $conflictType
     */
    #[Required('conflict_type', enum: ConflictType::class)]
    public string $conflictType;

    /**
     * Describe the conflict.
     */
    #[Required]
    public string $description;

    /**
     * Who is involved in the conflict.
     *
     * @var list<string> $partiesInvolved
     */
    #[Required('parties_involved', list: 'string')]
    public array $partiesInvolved;

    /**
     * What you've already tried.
     *
     * @var list<string>|null $attemptsMade
     */
    #[Optional('attempts_made', list: 'string', nullable: true)]
    public ?array $attemptsMade;

    /**
     * `new ConflictResolveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConflictResolveParams::with(
     *   conflictType: ..., description: ..., partiesInvolved: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConflictResolveParams)
     *   ->withConflictType(...)
     *   ->withDescription(...)
     *   ->withPartiesInvolved(...)
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
     * @param ConflictType|value-of<ConflictType> $conflictType
     * @param list<string> $partiesInvolved
     * @param list<string>|null $attemptsMade
     */
    public static function with(
        ConflictType|string $conflictType,
        string $description,
        array $partiesInvolved,
        ?array $attemptsMade = null,
    ): self {
        $self = new self;

        $self['conflictType'] = $conflictType;
        $self['description'] = $description;
        $self['partiesInvolved'] = $partiesInvolved;

        null !== $attemptsMade && $self['attemptsMade'] = $attemptsMade;

        return $self;
    }

    /**
     * Type of conflict.
     *
     * @param ConflictType|value-of<ConflictType> $conflictType
     */
    public function withConflictType(ConflictType|string $conflictType): self
    {
        $self = clone $this;
        $self['conflictType'] = $conflictType;

        return $self;
    }

    /**
     * Describe the conflict.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Who is involved in the conflict.
     *
     * @param list<string> $partiesInvolved
     */
    public function withPartiesInvolved(array $partiesInvolved): self
    {
        $self = clone $this;
        $self['partiesInvolved'] = $partiesInvolved;

        return $self;
    }

    /**
     * What you've already tried.
     *
     * @param list<string>|null $attemptsMade
     */
    public function withAttemptsMade(?array $attemptsMade): self
    {
        $self = clone $this;
        $self['attemptsMade'] = $attemptsMade;

        return $self;
    }
}

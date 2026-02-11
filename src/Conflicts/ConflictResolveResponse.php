<?php

declare(strict_types=1);

namespace Believe\Conflicts;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
 * Conflict resolution response.
 *
 * @phpstan-type ConflictResolveResponseShape = array{
 *   barbecueSauceWisdom: string,
 *   diagnosis: string,
 *   diamondDogsAdvice: string,
 *   potentialOutcome: string,
 *   stepsToResolution: list<string>,
 *   tedApproach: string,
 * }
 */
final class ConflictResolveResponse implements BaseModel
{
    /** @use SdkModel<ConflictResolveResponseShape> */
    use SdkModel;

    /**
     * A folksy metaphor to remember.
     */
    #[Required('barbecue_sauce_wisdom')]
    public string $barbecueSauceWisdom;

    /**
     * Understanding the root cause.
     */
    #[Required]
    public string $diagnosis;

    /**
     * Advice from the Diamond Dogs support group.
     */
    #[Required('diamond_dogs_advice')]
    public string $diamondDogsAdvice;

    /**
     * What resolution could look like.
     */
    #[Required('potential_outcome')]
    public string $potentialOutcome;

    /**
     * Concrete steps to resolve the conflict.
     *
     * @var list<string> $stepsToResolution
     */
    #[Required('steps_to_resolution', list: 'string')]
    public array $stepsToResolution;

    /**
     * How Ted would handle this.
     */
    #[Required('ted_approach')]
    public string $tedApproach;

    /**
     * `new ConflictResolveResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConflictResolveResponse::with(
     *   barbecueSauceWisdom: ...,
     *   diagnosis: ...,
     *   diamondDogsAdvice: ...,
     *   potentialOutcome: ...,
     *   stepsToResolution: ...,
     *   tedApproach: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConflictResolveResponse)
     *   ->withBarbecueSauceWisdom(...)
     *   ->withDiagnosis(...)
     *   ->withDiamondDogsAdvice(...)
     *   ->withPotentialOutcome(...)
     *   ->withStepsToResolution(...)
     *   ->withTedApproach(...)
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
     * @param list<string> $stepsToResolution
     */
    public static function with(
        string $barbecueSauceWisdom,
        string $diagnosis,
        string $diamondDogsAdvice,
        string $potentialOutcome,
        array $stepsToResolution,
        string $tedApproach,
    ): self {
        $self = new self;

        $self['barbecueSauceWisdom'] = $barbecueSauceWisdom;
        $self['diagnosis'] = $diagnosis;
        $self['diamondDogsAdvice'] = $diamondDogsAdvice;
        $self['potentialOutcome'] = $potentialOutcome;
        $self['stepsToResolution'] = $stepsToResolution;
        $self['tedApproach'] = $tedApproach;

        return $self;
    }

    /**
     * A folksy metaphor to remember.
     */
    public function withBarbecueSauceWisdom(string $barbecueSauceWisdom): self
    {
        $self = clone $this;
        $self['barbecueSauceWisdom'] = $barbecueSauceWisdom;

        return $self;
    }

    /**
     * Understanding the root cause.
     */
    public function withDiagnosis(string $diagnosis): self
    {
        $self = clone $this;
        $self['diagnosis'] = $diagnosis;

        return $self;
    }

    /**
     * Advice from the Diamond Dogs support group.
     */
    public function withDiamondDogsAdvice(string $diamondDogsAdvice): self
    {
        $self = clone $this;
        $self['diamondDogsAdvice'] = $diamondDogsAdvice;

        return $self;
    }

    /**
     * What resolution could look like.
     */
    public function withPotentialOutcome(string $potentialOutcome): self
    {
        $self = clone $this;
        $self['potentialOutcome'] = $potentialOutcome;

        return $self;
    }

    /**
     * Concrete steps to resolve the conflict.
     *
     * @param list<string> $stepsToResolution
     */
    public function withStepsToResolution(array $stepsToResolution): self
    {
        $self = clone $this;
        $self['stepsToResolution'] = $stepsToResolution;

        return $self;
    }

    /**
     * How Ted would handle this.
     */
    public function withTedApproach(string $tedApproach): self
    {
        $self = clone $this;
        $self['tedApproach'] = $tedApproach;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Believe\Characters;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
 * Emotional intelligence statistics for a character.
 *
 * @phpstan-type EmotionalStatsShape = array{
 *   curiosity: int,
 *   empathy: int,
 *   optimism: int,
 *   resilience: int,
 *   vulnerability: int,
 * }
 */
final class EmotionalStats implements BaseModel
{
    /** @use SdkModel<EmotionalStatsShape> */
    use SdkModel;

    /**
     * Level of curiosity over judgment (0-100).
     */
    #[Required]
    public int $curiosity;

    /**
     * Capacity for empathy (0-100).
     */
    #[Required]
    public int $empathy;

    /**
     * Level of optimism (0-100).
     */
    #[Required]
    public int $optimism;

    /**
     * Bounce-back ability (0-100).
     */
    #[Required]
    public int $resilience;

    /**
     * Willingness to be vulnerable (0-100).
     */
    #[Required]
    public int $vulnerability;

    /**
     * `new EmotionalStats()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EmotionalStats::with(
     *   curiosity: ...,
     *   empathy: ...,
     *   optimism: ...,
     *   resilience: ...,
     *   vulnerability: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EmotionalStats)
     *   ->withCuriosity(...)
     *   ->withEmpathy(...)
     *   ->withOptimism(...)
     *   ->withResilience(...)
     *   ->withVulnerability(...)
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
     */
    public static function with(
        int $curiosity,
        int $empathy,
        int $optimism,
        int $resilience,
        int $vulnerability,
    ): self {
        $self = new self;

        $self['curiosity'] = $curiosity;
        $self['empathy'] = $empathy;
        $self['optimism'] = $optimism;
        $self['resilience'] = $resilience;
        $self['vulnerability'] = $vulnerability;

        return $self;
    }

    /**
     * Level of curiosity over judgment (0-100).
     */
    public function withCuriosity(int $curiosity): self
    {
        $self = clone $this;
        $self['curiosity'] = $curiosity;

        return $self;
    }

    /**
     * Capacity for empathy (0-100).
     */
    public function withEmpathy(int $empathy): self
    {
        $self = clone $this;
        $self['empathy'] = $empathy;

        return $self;
    }

    /**
     * Level of optimism (0-100).
     */
    public function withOptimism(int $optimism): self
    {
        $self = clone $this;
        $self['optimism'] = $optimism;

        return $self;
    }

    /**
     * Bounce-back ability (0-100).
     */
    public function withResilience(int $resilience): self
    {
        $self = clone $this;
        $self['resilience'] = $resilience;

        return $self;
    }

    /**
     * Willingness to be vulnerable (0-100).
     */
    public function withVulnerability(int $vulnerability): self
    {
        $self = clone $this;
        $self['vulnerability'] = $vulnerability;

        return $self;
    }
}

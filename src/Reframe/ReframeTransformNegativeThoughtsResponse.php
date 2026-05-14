<?php

declare(strict_types=1);

namespace Believe\Reframe;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
 * Reframed perspective response.
 *
 * @phpstan-type ReframeTransformNegativeThoughtsResponseShape = array{
 *   dailyAffirmation: string,
 *   originalThought: string,
 *   reframedThought: string,
 *   tedPerspective: string,
 *   drSharonInsight?: string|null,
 * }
 */
final class ReframeTransformNegativeThoughtsResponse implements BaseModel
{
    /** @use SdkModel<ReframeTransformNegativeThoughtsResponseShape> */
    use SdkModel;

    /**
     * A daily affirmation to practice.
     */
    #[Required('daily_affirmation')]
    public string $dailyAffirmation;

    /**
     * The original negative thought.
     */
    #[Required('original_thought')]
    public string $originalThought;

    /**
     * The thought reframed positively.
     */
    #[Required('reframed_thought')]
    public string $reframedThought;

    /**
     * Ted's take on this thought.
     */
    #[Required('ted_perspective')]
    public string $tedPerspective;

    /**
     * Dr. Sharon's therapeutic insight.
     */
    #[Optional('dr_sharon_insight', nullable: true)]
    public ?string $drSharonInsight;

    /**
     * `new ReframeTransformNegativeThoughtsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReframeTransformNegativeThoughtsResponse::with(
     *   dailyAffirmation: ...,
     *   originalThought: ...,
     *   reframedThought: ...,
     *   tedPerspective: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReframeTransformNegativeThoughtsResponse)
     *   ->withDailyAffirmation(...)
     *   ->withOriginalThought(...)
     *   ->withReframedThought(...)
     *   ->withTedPerspective(...)
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
        string $dailyAffirmation,
        string $originalThought,
        string $reframedThought,
        string $tedPerspective,
        ?string $drSharonInsight = null,
    ): self {
        $self = new self;

        $self['dailyAffirmation'] = $dailyAffirmation;
        $self['originalThought'] = $originalThought;
        $self['reframedThought'] = $reframedThought;
        $self['tedPerspective'] = $tedPerspective;

        null !== $drSharonInsight && $self['drSharonInsight'] = $drSharonInsight;

        return $self;
    }

    /**
     * A daily affirmation to practice.
     */
    public function withDailyAffirmation(string $dailyAffirmation): self
    {
        $self = clone $this;
        $self['dailyAffirmation'] = $dailyAffirmation;

        return $self;
    }

    /**
     * The original negative thought.
     */
    public function withOriginalThought(string $originalThought): self
    {
        $self = clone $this;
        $self['originalThought'] = $originalThought;

        return $self;
    }

    /**
     * The thought reframed positively.
     */
    public function withReframedThought(string $reframedThought): self
    {
        $self = clone $this;
        $self['reframedThought'] = $reframedThought;

        return $self;
    }

    /**
     * Ted's take on this thought.
     */
    public function withTedPerspective(string $tedPerspective): self
    {
        $self = clone $this;
        $self['tedPerspective'] = $tedPerspective;

        return $self;
    }

    /**
     * Dr. Sharon's therapeutic insight.
     */
    public function withDrSharonInsight(?string $drSharonInsight): self
    {
        $self = clone $this;
        $self['drSharonInsight'] = $drSharonInsight;

        return $self;
    }
}

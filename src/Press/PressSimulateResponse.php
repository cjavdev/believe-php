<?php

declare(strict_types=1);

namespace Believe\Press;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
 * Ted's press conference response.
 *
 * @phpstan-type PressSimulateResponseShape = array{
 *   actualWisdom: string,
 *   followUpDodge: string,
 *   reporterReaction: string,
 *   response: string,
 *   deflectionHumor?: string|null,
 * }
 */
final class PressSimulateResponse implements BaseModel
{
    /** @use SdkModel<PressSimulateResponseShape> */
    use SdkModel;

    /**
     * The actual wisdom beneath the humor.
     */
    #[Required('actual_wisdom')]
    public string $actualWisdom;

    /**
     * How Ted would dodge a follow-up.
     */
    #[Required('follow_up_dodge')]
    public string $followUpDodge;

    /**
     * How reporters would react.
     */
    #[Required('reporter_reaction')]
    public string $reporterReaction;

    /**
     * Ted's press conference answer.
     */
    #[Required]
    public string $response;

    /**
     * Humorous deflection if appropriate.
     */
    #[Optional('deflection_humor', nullable: true)]
    public ?string $deflectionHumor;

    /**
     * `new PressSimulateResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PressSimulateResponse::with(
     *   actualWisdom: ..., followUpDodge: ..., reporterReaction: ..., response: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PressSimulateResponse)
     *   ->withActualWisdom(...)
     *   ->withFollowUpDodge(...)
     *   ->withReporterReaction(...)
     *   ->withResponse(...)
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
        string $actualWisdom,
        string $followUpDodge,
        string $reporterReaction,
        string $response,
        ?string $deflectionHumor = null,
    ): self {
        $self = new self;

        $self['actualWisdom'] = $actualWisdom;
        $self['followUpDodge'] = $followUpDodge;
        $self['reporterReaction'] = $reporterReaction;
        $self['response'] = $response;

        null !== $deflectionHumor && $self['deflectionHumor'] = $deflectionHumor;

        return $self;
    }

    /**
     * The actual wisdom beneath the humor.
     */
    public function withActualWisdom(string $actualWisdom): self
    {
        $self = clone $this;
        $self['actualWisdom'] = $actualWisdom;

        return $self;
    }

    /**
     * How Ted would dodge a follow-up.
     */
    public function withFollowUpDodge(string $followUpDodge): self
    {
        $self = clone $this;
        $self['followUpDodge'] = $followUpDodge;

        return $self;
    }

    /**
     * How reporters would react.
     */
    public function withReporterReaction(string $reporterReaction): self
    {
        $self = clone $this;
        $self['reporterReaction'] = $reporterReaction;

        return $self;
    }

    /**
     * Ted's press conference answer.
     */
    public function withResponse(string $response): self
    {
        $self = clone $this;
        $self['response'] = $response;

        return $self;
    }

    /**
     * Humorous deflection if appropriate.
     */
    public function withDeflectionHumor(?string $deflectionHumor): self
    {
        $self = clone $this;
        $self['deflectionHumor'] = $deflectionHumor;

        return $self;
    }
}

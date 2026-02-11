<?php

declare(strict_types=1);

namespace Believe\Coaching\Principles;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
 * A Ted Lasso coaching principle.
 *
 * @phpstan-type CoachingPrincipleShape = array{
 *   id: string,
 *   application: string,
 *   exampleFromShow: string,
 *   explanation: string,
 *   principle: string,
 *   tedQuote: string,
 * }
 */
final class CoachingPrinciple implements BaseModel
{
    /** @use SdkModel<CoachingPrincipleShape> */
    use SdkModel;

    /**
     * Principle identifier.
     */
    #[Required]
    public string $id;

    /**
     * How to apply this principle.
     */
    #[Required]
    public string $application;

    /**
     * Example from the show.
     */
    #[Required('example_from_show')]
    public string $exampleFromShow;

    /**
     * What this principle means.
     */
    #[Required]
    public string $explanation;

    /**
     * The coaching principle.
     */
    #[Required]
    public string $principle;

    /**
     * Related Ted quote.
     */
    #[Required('ted_quote')]
    public string $tedQuote;

    /**
     * `new CoachingPrinciple()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CoachingPrinciple::with(
     *   id: ...,
     *   application: ...,
     *   exampleFromShow: ...,
     *   explanation: ...,
     *   principle: ...,
     *   tedQuote: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CoachingPrinciple)
     *   ->withID(...)
     *   ->withApplication(...)
     *   ->withExampleFromShow(...)
     *   ->withExplanation(...)
     *   ->withPrinciple(...)
     *   ->withTedQuote(...)
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
        string $id,
        string $application,
        string $exampleFromShow,
        string $explanation,
        string $principle,
        string $tedQuote,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['application'] = $application;
        $self['exampleFromShow'] = $exampleFromShow;
        $self['explanation'] = $explanation;
        $self['principle'] = $principle;
        $self['tedQuote'] = $tedQuote;

        return $self;
    }

    /**
     * Principle identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * How to apply this principle.
     */
    public function withApplication(string $application): self
    {
        $self = clone $this;
        $self['application'] = $application;

        return $self;
    }

    /**
     * Example from the show.
     */
    public function withExampleFromShow(string $exampleFromShow): self
    {
        $self = clone $this;
        $self['exampleFromShow'] = $exampleFromShow;

        return $self;
    }

    /**
     * What this principle means.
     */
    public function withExplanation(string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * The coaching principle.
     */
    public function withPrinciple(string $principle): self
    {
        $self = clone $this;
        $self['principle'] = $principle;

        return $self;
    }

    /**
     * Related Ted quote.
     */
    public function withTedQuote(string $tedQuote): self
    {
        $self = clone $this;
        $self['tedQuote'] = $tedQuote;

        return $self;
    }
}

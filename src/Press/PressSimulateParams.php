<?php

declare(strict_types=1);

namespace Believe\Press;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Concerns\SdkParams;
use Believe\Core\Contracts\BaseModel;

/**
 * Get Ted's response to press conference questions.
 *
 * @see Believe\Services\PressService::simulate()
 *
 * @phpstan-type PressSimulateParamsShape = array{
 *   question: string, hostile?: bool|null, topic?: string|null
 * }
 */
final class PressSimulateParams implements BaseModel
{
    /** @use SdkModel<PressSimulateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The press question to answer.
     */
    #[Required]
    public string $question;

    /**
     * Is this a hostile question from Trent Crimm?
     */
    #[Optional]
    public ?bool $hostile;

    /**
     * Topic category.
     */
    #[Optional(nullable: true)]
    public ?string $topic;

    /**
     * `new PressSimulateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PressSimulateParams::with(question: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PressSimulateParams)->withQuestion(...)
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
        string $question,
        ?bool $hostile = null,
        ?string $topic = null
    ): self {
        $self = new self;

        $self['question'] = $question;

        null !== $hostile && $self['hostile'] = $hostile;
        null !== $topic && $self['topic'] = $topic;

        return $self;
    }

    /**
     * The press question to answer.
     */
    public function withQuestion(string $question): self
    {
        $self = clone $this;
        $self['question'] = $question;

        return $self;
    }

    /**
     * Is this a hostile question from Trent Crimm?
     */
    public function withHostile(bool $hostile): self
    {
        $self = clone $this;
        $self['hostile'] = $hostile;

        return $self;
    }

    /**
     * Topic category.
     */
    public function withTopic(?string $topic): self
    {
        $self = clone $this;
        $self['topic'] = $topic;

        return $self;
    }
}

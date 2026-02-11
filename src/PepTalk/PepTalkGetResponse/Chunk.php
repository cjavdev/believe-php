<?php

declare(strict_types=1);

namespace Believe\PepTalk\PepTalkGetResponse;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
 * A chunk of a streaming pep talk from Ted.
 *
 * @phpstan-type ChunkShape = array{
 *   chunkID: int, isFinal: bool, text: string, emotionalBeat?: string|null
 * }
 */
final class Chunk implements BaseModel
{
    /** @use SdkModel<ChunkShape> */
    use SdkModel;

    /**
     * Chunk sequence number.
     */
    #[Required('chunk_id')]
    public int $chunkID;

    /**
     * Is this the final chunk.
     */
    #[Required('is_final')]
    public bool $isFinal;

    /**
     * The text of this chunk.
     */
    #[Required]
    public string $text;

    /**
     * The emotional purpose of this chunk (e.g., greeting, acknowledgment, wisdom, affirmation, encouragement).
     */
    #[Optional('emotional_beat', nullable: true)]
    public ?string $emotionalBeat;

    /**
     * `new Chunk()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Chunk::with(chunkID: ..., isFinal: ..., text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Chunk)->withChunkID(...)->withIsFinal(...)->withText(...)
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
        int $chunkID,
        string $text,
        bool $isFinal = false,
        ?string $emotionalBeat = null,
    ): self {
        $self = new self;

        $self['chunkID'] = $chunkID;
        $self['isFinal'] = $isFinal;
        $self['text'] = $text;

        null !== $emotionalBeat && $self['emotionalBeat'] = $emotionalBeat;

        return $self;
    }

    /**
     * Chunk sequence number.
     */
    public function withChunkID(int $chunkID): self
    {
        $self = clone $this;
        $self['chunkID'] = $chunkID;

        return $self;
    }

    /**
     * Is this the final chunk.
     */
    public function withIsFinal(bool $isFinal): self
    {
        $self = clone $this;
        $self['isFinal'] = $isFinal;

        return $self;
    }

    /**
     * The text of this chunk.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * The emotional purpose of this chunk (e.g., greeting, acknowledgment, wisdom, affirmation, encouragement).
     */
    public function withEmotionalBeat(?string $emotionalBeat): self
    {
        $self = clone $this;
        $self['emotionalBeat'] = $emotionalBeat;

        return $self;
    }
}

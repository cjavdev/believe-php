<?php

declare(strict_types=1);

namespace Believe\Believe;

use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;

/**
  * Response from the Believe Engine.
  *
  * @phpstan-type BelieveSubmitResponseShape = array{
  *   actionSuggestion: string,
  *   believeScore: int,
  *   goldfishWisdom: string,
  *   relevantQuote: string,
  *   tedResponse: string,
  * }
  *
 */
final class BelieveSubmitResponse implements BaseModel
{
  /** @use SdkModel<BelieveSubmitResponseShape> */
  use SdkModel;

  /**
  * Suggested action to take
  *
  * @var string $actionSuggestion
 */
  #[Required('action_suggestion')]
  public string $actionSuggestion;

  /**
  * Your current believe-o-meter score
  *
  * @var int $believeScore
 */
  #[Required('believe_score')]
  public int $believeScore;

  /**
  * A reminder to have a goldfish memory when needed
  *
  * @var string $goldfishWisdom
 */
  #[Required('goldfish_wisdom')]
  public string $goldfishWisdom;

  /**
  * A relevant Ted Lasso quote
  *
  * @var string $relevantQuote
 */
  #[Required('relevant_quote')]
  public string $relevantQuote;

  /**
  * Ted's motivational response
  *
  * @var string $tedResponse
 */
  #[Required('ted_response')]
  public string $tedResponse;

  /**
  * `new BelieveSubmitResponse()` is missing required properties by the API.
  *
  * To enforce required parameters use
  * ```
  * BelieveSubmitResponse::with(
  *   actionSuggestion: ...,
  *   believeScore: ...,
  *   goldfishWisdom: ...,
  *   relevantQuote: ...,
  *   tedResponse: ...,
  * )
  * ```
  *
  * Otherwise ensure the following setters are called
  *
  * ```
  * (new BelieveSubmitResponse)
  *   ->withActionSuggestion(...)
  *   ->withBelieveScore(...)
  *   ->withGoldfishWisdom(...)
  *   ->withRelevantQuote(...)
  *   ->withTedResponse(...)
  * ```
 */
  public function __construct() {$this->initialize();}

  /**
  * Construct an instance from the required parameters.
  *
  * You must use named parameters to construct any parameters with a default value.
  *
  * @param string $actionSuggestion
  * @param int $believeScore
  * @param string $goldfishWisdom
  * @param string $relevantQuote
  * @param string $tedResponse
  *
  * @return self
 */
  public static function with(
    string $actionSuggestion,
    int $believeScore,
    string $goldfishWisdom,
    string $relevantQuote,
    string $tedResponse,
  ): self {
    $self = new self;

    $self['actionSuggestion'] = $actionSuggestion;
    $self['believeScore'] = $believeScore;
    $self['goldfishWisdom'] = $goldfishWisdom;
    $self['relevantQuote'] = $relevantQuote;
    $self['tedResponse'] = $tedResponse;

    return $self;
  }

  /**
  * Suggested action to take
  *
  * @param string $actionSuggestion
  *
  * @return self
 */
  public function withActionSuggestion(string $actionSuggestion): self {
    $self = clone $this;
    $self['actionSuggestion'] = $actionSuggestion;
    return $self;
  }

  /**
  * Your current believe-o-meter score
  *
  * @param int $believeScore
  *
  * @return self
 */
  public function withBelieveScore(int $believeScore): self {
    $self = clone $this;
    $self['believeScore'] = $believeScore;
    return $self;
  }

  /**
  * A reminder to have a goldfish memory when needed
  *
  * @param string $goldfishWisdom
  *
  * @return self
 */
  public function withGoldfishWisdom(string $goldfishWisdom): self {
    $self = clone $this;
    $self['goldfishWisdom'] = $goldfishWisdom;
    return $self;
  }

  /**
  * A relevant Ted Lasso quote
  *
  * @param string $relevantQuote
  *
  * @return self
 */
  public function withRelevantQuote(string $relevantQuote): self {
    $self = clone $this;
    $self['relevantQuote'] = $relevantQuote;
    return $self;
  }

  /**
  * Ted's motivational response
  *
  * @param string $tedResponse
  *
  * @return self
 */
  public function withTedResponse(string $tedResponse): self {
    $self = clone $this;
    $self['tedResponse'] = $tedResponse;
    return $self;
  }
}
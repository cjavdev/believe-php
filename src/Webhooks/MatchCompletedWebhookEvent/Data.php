<?php

declare(strict_types=1);

namespace Believe\Webhooks\MatchCompletedWebhookEvent;

use Believe\Core\Attributes\Optional;
use Believe\Core\Attributes\Required;
use Believe\Core\Concerns\SdkModel;
use Believe\Core\Contracts\BaseModel;
use Believe\Webhooks\MatchCompletedWebhookEvent\Data\MatchType;
use Believe\Webhooks\MatchCompletedWebhookEvent\Data\Result;

/**
 * Data payload for a match completed event.
 *
 * @phpstan-type DataShape = array{
 *   awayScore: int,
 *   awayTeamID: string,
 *   completedAt: \DateTimeInterface,
 *   homeScore: int,
 *   homeTeamID: string,
 *   matchID: string,
 *   matchType: MatchType|value-of<MatchType>,
 *   result: Result|value-of<Result>,
 *   tedPostMatchQuote: string,
 *   lessonLearned?: string|null,
 *   manOfTheMatch?: string|null,
 * }
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Final away team score.
     */
    #[Required('away_score')]
    public int $awayScore;

    /**
     * Away team ID.
     */
    #[Required('away_team_id')]
    public string $awayTeamID;

    /**
     * When the match completed.
     */
    #[Required('completed_at')]
    public \DateTimeInterface $completedAt;

    /**
     * Final home team score.
     */
    #[Required('home_score')]
    public int $homeScore;

    /**
     * Home team ID.
     */
    #[Required('home_team_id')]
    public string $homeTeamID;

    /**
     * Unique match identifier.
     */
    #[Required('match_id')]
    public string $matchID;

    /**
     * Type of match.
     *
     * @var value-of<MatchType> $matchType
     */
    #[Required('match_type', enum: MatchType::class)]
    public string $matchType;

    /**
     * Match result from home team perspective.
     *
     * @var value-of<Result> $result
     */
    #[Required(enum: Result::class)]
    public string $result;

    /**
     * Ted's post-match wisdom.
     */
    #[Required('ted_post_match_quote')]
    public string $tedPostMatchQuote;

    /**
     * Ted's lesson from the match.
     */
    #[Optional('lesson_learned', nullable: true)]
    public ?string $lessonLearned;

    /**
     * Player of the match (if awarded).
     */
    #[Optional('man_of_the_match', nullable: true)]
    public ?string $manOfTheMatch;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(
     *   awayScore: ...,
     *   awayTeamID: ...,
     *   completedAt: ...,
     *   homeScore: ...,
     *   homeTeamID: ...,
     *   matchID: ...,
     *   matchType: ...,
     *   result: ...,
     *   tedPostMatchQuote: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)
     *   ->withAwayScore(...)
     *   ->withAwayTeamID(...)
     *   ->withCompletedAt(...)
     *   ->withHomeScore(...)
     *   ->withHomeTeamID(...)
     *   ->withMatchID(...)
     *   ->withMatchType(...)
     *   ->withResult(...)
     *   ->withTedPostMatchQuote(...)
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
     * @param MatchType|value-of<MatchType> $matchType
     * @param Result|value-of<Result> $result
     */
    public static function with(
        int $awayScore,
        string $awayTeamID,
        \DateTimeInterface $completedAt,
        int $homeScore,
        string $homeTeamID,
        string $matchID,
        MatchType|string $matchType,
        Result|string $result,
        string $tedPostMatchQuote,
        ?string $lessonLearned = null,
        ?string $manOfTheMatch = null,
    ): self {
        $self = new self;

        $self['awayScore'] = $awayScore;
        $self['awayTeamID'] = $awayTeamID;
        $self['completedAt'] = $completedAt;
        $self['homeScore'] = $homeScore;
        $self['homeTeamID'] = $homeTeamID;
        $self['matchID'] = $matchID;
        $self['matchType'] = $matchType;
        $self['result'] = $result;
        $self['tedPostMatchQuote'] = $tedPostMatchQuote;

        null !== $lessonLearned && $self['lessonLearned'] = $lessonLearned;
        null !== $manOfTheMatch && $self['manOfTheMatch'] = $manOfTheMatch;

        return $self;
    }

    /**
     * Final away team score.
     */
    public function withAwayScore(int $awayScore): self
    {
        $self = clone $this;
        $self['awayScore'] = $awayScore;

        return $self;
    }

    /**
     * Away team ID.
     */
    public function withAwayTeamID(string $awayTeamID): self
    {
        $self = clone $this;
        $self['awayTeamID'] = $awayTeamID;

        return $self;
    }

    /**
     * When the match completed.
     */
    public function withCompletedAt(\DateTimeInterface $completedAt): self
    {
        $self = clone $this;
        $self['completedAt'] = $completedAt;

        return $self;
    }

    /**
     * Final home team score.
     */
    public function withHomeScore(int $homeScore): self
    {
        $self = clone $this;
        $self['homeScore'] = $homeScore;

        return $self;
    }

    /**
     * Home team ID.
     */
    public function withHomeTeamID(string $homeTeamID): self
    {
        $self = clone $this;
        $self['homeTeamID'] = $homeTeamID;

        return $self;
    }

    /**
     * Unique match identifier.
     */
    public function withMatchID(string $matchID): self
    {
        $self = clone $this;
        $self['matchID'] = $matchID;

        return $self;
    }

    /**
     * Type of match.
     *
     * @param MatchType|value-of<MatchType> $matchType
     */
    public function withMatchType(MatchType|string $matchType): self
    {
        $self = clone $this;
        $self['matchType'] = $matchType;

        return $self;
    }

    /**
     * Match result from home team perspective.
     *
     * @param Result|value-of<Result> $result
     */
    public function withResult(Result|string $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }

    /**
     * Ted's post-match wisdom.
     */
    public function withTedPostMatchQuote(string $tedPostMatchQuote): self
    {
        $self = clone $this;
        $self['tedPostMatchQuote'] = $tedPostMatchQuote;

        return $self;
    }

    /**
     * Ted's lesson from the match.
     */
    public function withLessonLearned(?string $lessonLearned): self
    {
        $self = clone $this;
        $self['lessonLearned'] = $lessonLearned;

        return $self;
    }

    /**
     * Player of the match (if awarded).
     */
    public function withManOfTheMatch(?string $manOfTheMatch): self
    {
        $self = clone $this;
        $self['manOfTheMatch'] = $manOfTheMatch;

        return $self;
    }
}

<?php

declare(strict_types=1);

namespace Believe\ServiceContracts;

use Believe\RequestOptions;
use Believe\SkipLimitPage;
use Believe\Core\Exceptions\APIException;
use Believe\Quotes\QuoteMoment;
use Believe\Quotes\QuoteTheme;
use Believe\Quotes\Quote;

/**
  * @phpstan-import-type RequestOpts from \Believe\RequestOptions
  *
 */
interface QuotesContract{

    /**
  * @api
  *
  * @param string $characterID ID of the character who said it
  * @param string $context Context in which the quote was said
  * @param QuoteMoment|value-of<QuoteMoment> $momentType Type of moment when the quote was said
  * @param string $text The quote text
  * @param QuoteTheme|value-of<QuoteTheme> $theme Primary theme of the quote
  * @param string|null $episodeID Episode where the quote appears
  * @param bool $isFunny Whether this quote is humorous
  * @param bool $isInspirational Whether this quote is inspirational
  * @param float|null $popularityScore Popularity/virality score (0-100)
  * @param list<QuoteTheme|value-of<QuoteTheme>> $secondaryThemes Additional themes
  * @param int|null $timesShared Number of times shared on social media
  * @param RequestOpts|null $requestOptions
  *
  * @return Quote
  *
  * @throws APIException
 */
    public function create(
      string $characterID,
      string $context,
      QuoteMoment|string $momentType,
      string $text,
      QuoteTheme|string $theme,
      ?string $episodeID = null,
      bool $isFunny = false,
      bool $isInspirational = true,
      ?float $popularityScore = null,
      array $secondaryThemes = null,
      ?int $timesShared = null,
      null|RequestOptions|array $requestOptions = null,
    ): Quote;

    /**
  * @api
  *
  * @param string $quoteID
  * @param RequestOpts|null $requestOptions
  *
  * @return Quote
  *
  * @throws APIException
 */
    public function retrieve(
      string $quoteID, null|RequestOptions|array $requestOptions = null
    ): Quote;

    /**
  * @api
  *
  * @param string $quoteID
  * @param string|null $characterID
  * @param string|null $context
  * @param string|null $episodeID
  * @param bool|null $isFunny
  * @param bool|null $isInspirational
  * @param null|QuoteMoment|value-of<QuoteMoment> $momentType Types of moments when quotes occur.
  * @param float|null $popularityScore
  * @param list<QuoteTheme|value-of<QuoteTheme>>|null $secondaryThemes
  * @param string|null $text
  * @param null|QuoteTheme|value-of<QuoteTheme> $theme Themes that quotes can be categorized under.
  * @param int|null $timesShared
  * @param RequestOpts|null $requestOptions
  *
  * @return Quote
  *
  * @throws APIException
 */
    public function update(
      string $quoteID,
      ?string $characterID = null,
      ?string $context = null,
      ?string $episodeID = null,
      ?bool $isFunny = null,
      ?bool $isInspirational = null,
      null|QuoteMoment|string $momentType = null,
      ?float $popularityScore = null,
      ?array $secondaryThemes = null,
      ?string $text = null,
      null|QuoteTheme|string $theme = null,
      ?int $timesShared = null,
      null|RequestOptions|array $requestOptions = null,
    ): Quote;

    /**
  * @api
  *
  * @param string|null $characterID Filter by character
  * @param bool|null $funny Filter funny quotes
  * @param bool|null $inspirational Filter inspirational quotes
  * @param int $limit Maximum number of items to return (max: 100)
  * @param null|QuoteMoment|value-of<QuoteMoment> $momentType Filter by moment type
  * @param int $skip Number of items to skip (offset)
  * @param null|QuoteTheme|value-of<QuoteTheme> $theme Filter by theme
  * @param RequestOpts|null $requestOptions
  *
  * @return SkipLimitPage<Quote>
  *
  * @throws APIException
 */
    public function list(
      ?string $characterID = null,
      ?bool $funny = null,
      ?bool $inspirational = null,
      int $limit = 20,
      null|QuoteMoment|string $momentType = null,
      int $skip = 0,
      null|QuoteTheme|string $theme = null,
      null|RequestOptions|array $requestOptions = null,
    ): SkipLimitPage;

    /**
  * @api
  *
  * @param string $quoteID
  * @param RequestOpts|null $requestOptions
  *
  * @return mixed
  *
  * @throws APIException
 */
    public function delete(
      string $quoteID, null|RequestOptions|array $requestOptions = null
    ): mixed;

    /**
  * @api
  *
  * @param string|null $characterID Filter by character
  * @param bool|null $inspirational Filter inspirational quotes
  * @param null|QuoteTheme|value-of<QuoteTheme> $theme Filter by theme
  * @param RequestOpts|null $requestOptions
  *
  * @return Quote
  *
  * @throws APIException
 */
    public function getRandom(
      ?string $characterID = null,
      ?bool $inspirational = null,
      null|QuoteTheme|string $theme = null,
      null|RequestOptions|array $requestOptions = null,
    ): Quote;

    /**
  * @api
  *
  * @param string $characterID
  * @param int $limit Maximum number of items to return (max: 100)
  * @param int $skip Number of items to skip (offset)
  * @param RequestOpts|null $requestOptions
  *
  * @return SkipLimitPage<Quote>
  *
  * @throws APIException
 */
    public function listByCharacter(
      string $characterID,
      int $limit = 20,
      int $skip = 0,
      null|RequestOptions|array $requestOptions = null,
    ): SkipLimitPage;

    /**
  * @api
  *
  * @param QuoteTheme|string $theme Themes that quotes can be categorized under.
  * @param int $limit Maximum number of items to return (max: 100)
  * @param int $skip Number of items to skip (offset)
  * @param RequestOpts|null $requestOptions
  *
  * @return SkipLimitPage<Quote>
  *
  * @throws APIException
 */
    public function listByTheme(
      QuoteTheme|string $theme,
      int $limit = 20,
      int $skip = 0,
      null|RequestOptions|array $requestOptions = null,
    ): SkipLimitPage;

}
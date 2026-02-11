<?php

declare(strict_types=1);

namespace Believe\Services;

use Believe\Client;
use Believe\Core\Exceptions\APIException;
use Believe\Core\Util;
use Believe\Quotes\Quote;
use Believe\Quotes\QuoteMoment;
use Believe\Quotes\QuoteTheme;
use Believe\RequestOptions;
use Believe\ServiceContracts\QuotesContract;
use Believe\SkipLimitPage;

/**
 * @phpstan-import-type RequestOpts from \Believe\RequestOptions
 */
final class QuotesService implements QuotesContract
{
    /**
     * @api
     */
    public QuotesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new QuotesRawService($client);
    }

    /**
     * @api
     *
     * Add a new memorable quote to the collection.
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
        ?array $secondaryThemes = null,
        ?int $timesShared = null,
        RequestOptions|array|null $requestOptions = null,
    ): Quote {
        $params = Util::removeNulls(
            [
                'characterID' => $characterID,
                'context' => $context,
                'momentType' => $momentType,
                'text' => $text,
                'theme' => $theme,
                'episodeID' => $episodeID,
                'isFunny' => $isFunny,
                'isInspirational' => $isInspirational,
                'popularityScore' => $popularityScore,
                'secondaryThemes' => $secondaryThemes,
                'timesShared' => $timesShared,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a specific quote by its ID.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $quoteID,
        RequestOptions|array|null $requestOptions = null
    ): Quote {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($quoteID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update specific fields of an existing quote.
     *
     * @param QuoteMoment|value-of<QuoteMoment>|null $momentType types of moments when quotes occur
     * @param list<QuoteTheme|value-of<QuoteTheme>>|null $secondaryThemes
     * @param QuoteTheme|value-of<QuoteTheme>|null $theme themes that quotes can be categorized under
     * @param RequestOpts|null $requestOptions
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
        QuoteMoment|string|null $momentType = null,
        ?float $popularityScore = null,
        ?array $secondaryThemes = null,
        ?string $text = null,
        QuoteTheme|string|null $theme = null,
        ?int $timesShared = null,
        RequestOptions|array|null $requestOptions = null,
    ): Quote {
        $params = Util::removeNulls(
            [
                'characterID' => $characterID,
                'context' => $context,
                'episodeID' => $episodeID,
                'isFunny' => $isFunny,
                'isInspirational' => $isInspirational,
                'momentType' => $momentType,
                'popularityScore' => $popularityScore,
                'secondaryThemes' => $secondaryThemes,
                'text' => $text,
                'theme' => $theme,
                'timesShared' => $timesShared,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($quoteID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a paginated list of all memorable Ted Lasso quotes with optional filtering.
     *
     * @param string|null $characterID Filter by character
     * @param bool|null $funny Filter funny quotes
     * @param bool|null $inspirational Filter inspirational quotes
     * @param int $limit Maximum number of items to return (max: 100)
     * @param QuoteMoment|value-of<QuoteMoment>|null $momentType Filter by moment type
     * @param int $skip Number of items to skip (offset)
     * @param QuoteTheme|value-of<QuoteTheme>|null $theme Filter by theme
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
        QuoteMoment|string|null $momentType = null,
        int $skip = 0,
        QuoteTheme|string|null $theme = null,
        RequestOptions|array|null $requestOptions = null,
    ): SkipLimitPage {
        $params = Util::removeNulls(
            [
                'characterID' => $characterID,
                'funny' => $funny,
                'inspirational' => $inspirational,
                'limit' => $limit,
                'momentType' => $momentType,
                'skip' => $skip,
                'theme' => $theme,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Remove a quote from the collection.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $quoteID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($quoteID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a random Ted Lasso quote, optionally filtered.
     *
     * @param string|null $characterID Filter by character
     * @param bool|null $inspirational Filter inspirational quotes
     * @param QuoteTheme|value-of<QuoteTheme>|null $theme Filter by theme
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function getRandom(
        ?string $characterID = null,
        ?bool $inspirational = null,
        QuoteTheme|string|null $theme = null,
        RequestOptions|array|null $requestOptions = null,
    ): Quote {
        $params = Util::removeNulls(
            [
                'characterID' => $characterID,
                'inspirational' => $inspirational,
                'theme' => $theme,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->getRandom(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a paginated list of quotes from a specific character.
     *
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
        RequestOptions|array|null $requestOptions = null,
    ): SkipLimitPage {
        $params = Util::removeNulls(['limit' => $limit, 'skip' => $skip]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listByCharacter($characterID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get a paginated list of quotes related to a specific theme.
     *
     * @param QuoteTheme|value-of<QuoteTheme> $theme themes that quotes can be categorized under
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
        RequestOptions|array|null $requestOptions = null,
    ): SkipLimitPage {
        $params = Util::removeNulls(['limit' => $limit, 'skip' => $skip]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listByTheme($theme, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}

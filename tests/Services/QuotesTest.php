<?php

namespace Tests\Services;

use Believe\Client;
use Believe\Core\Util;
use Believe\Quotes\Quote;
use Believe\Quotes\QuoteMoment;
use Believe\Quotes\QuoteTheme;
use Believe\SkipLimitPage;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class QuotesTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->quotes->create(
            characterID: 'ted-lasso',
            context: 'Ted\'s first team meeting, revealing his coaching philosophy',
            momentType: QuoteMoment::LOCKER_ROOM,
            text: 'I believe in believe.',
            theme: QuoteTheme::BELIEF,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Quote::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->quotes->create(
            characterID: 'ted-lasso',
            context: 'Ted\'s first team meeting, revealing his coaching philosophy',
            momentType: QuoteMoment::LOCKER_ROOM,
            text: 'I believe in believe.',
            theme: QuoteTheme::BELIEF,
            episodeID: 's01e01',
            isFunny: false,
            isInspirational: true,
            popularityScore: 98.5,
            secondaryThemes: [QuoteTheme::LEADERSHIP, QuoteTheme::TEAMWORK],
            timesShared: 250000,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Quote::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->quotes->retrieve('quote_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Quote::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->quotes->update('quote_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Quote::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->quotes->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkipLimitPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Quote::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->quotes->delete('quote_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetRandom(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->quotes->getRandom();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Quote::class, $result);
    }

    #[Test]
    public function testListByCharacter(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->quotes->listByCharacter('character_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkipLimitPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Quote::class, $item);
        }
    }

    #[Test]
    public function testListByTheme(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->quotes->listByTheme(QuoteTheme::BELIEF);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkipLimitPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Quote::class, $item);
        }
    }
}

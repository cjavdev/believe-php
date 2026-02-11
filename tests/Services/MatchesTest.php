<?php

namespace Tests\Services;

use Believe\Client;
use Believe\Core\Util;
use Believe\Matches\Match_;
use Believe\Matches\MatchResult;
use Believe\Matches\MatchType;
use Believe\SkipLimitPage;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class MatchesTest extends TestCase
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

        $result = $this->client->matches->create(
            awayTeamID: 'tottenham',
            date: new \DateTimeImmutable('2024-02-20T19:45:00Z'),
            homeTeamID: 'afc-richmond',
            matchType: MatchType::CUP,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Match_::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->matches->create(
            awayTeamID: 'tottenham',
            date: new \DateTimeImmutable('2024-02-20T19:45:00Z'),
            homeTeamID: 'afc-richmond',
            matchType: MatchType::CUP,
            attendance: 24500,
            awayScore: 0,
            episodeID: 's02e05',
            homeScore: 0,
            lessonLearned: 'It\'s not about the wins and losses, it\'s about helping these young fellas be the best versions of themselves.',
            possessionPercentage: 50,
            result: MatchResult::PENDING,
            tedHalftimeSpeech: 'You know what the happiest animal on Earth is? It\'s a goldfish. You know why? It\'s got a 10-second memory.',
            ticketRevenueGbp: '735000.00',
            turningPoints: [
                [
                    'description' => 'description',
                    'emotionalImpact' => 'Galvanized the team\'s fighting spirit',
                    'minute' => 0,
                    'characterInvolved' => 'jamie-tartt',
                ],
            ],
            weatherTempCelsius: 8.5,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Match_::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->matches->retrieve('match_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Match_::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->matches->update('match_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Match_::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->matches->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkipLimitPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Match_::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->matches->delete('match_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetLesson(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->matches->getLesson('match_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsArray($result);
    }

    #[Test]
    public function testGetTurningPoints(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->matches->getTurningPoints('match_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsList($result);
    }

    #[Test]
    public function testStreamLive(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism doesn\'t support callbacks yet');
        }

        $result = $this->client->matches->streamLive();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}

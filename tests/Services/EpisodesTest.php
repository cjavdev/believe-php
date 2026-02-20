<?php

namespace Tests\Services;

use Believe\Client;
use Believe\Core\Util;
use Believe\Episodes\Episode;
use Believe\SkipLimitPage;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class EpisodesTest extends TestCase
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
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->episodes->create(
            airDate: '2020-10-02',
            characterFocus: ['ted-lasso', 'coach-beard', 'higgins', 'nate'],
            director: 'MJ Delaney',
            episodeNumber: 8,
            mainTheme: 'The power of vulnerability and male friendship',
            runtimeMinutes: 29,
            season: 1,
            synopsis: 'Ted creates a support group for the coaching staff while Rebecca faces a difficult decision about her future.',
            tedWisdom: 'There\'s two buttons I never like to hit: that\'s panic and snooze.',
            title: 'The Diamond Dogs',
            writer: 'Jason Sudeikis, Brendan Hunt, Joe Kelly',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Episode::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->episodes->create(
            airDate: '2020-10-02',
            characterFocus: ['ted-lasso', 'coach-beard', 'higgins', 'nate'],
            director: 'MJ Delaney',
            episodeNumber: 8,
            mainTheme: 'The power of vulnerability and male friendship',
            runtimeMinutes: 29,
            season: 1,
            synopsis: 'Ted creates a support group for the coaching staff while Rebecca faces a difficult decision about her future.',
            tedWisdom: 'There\'s two buttons I never like to hit: that\'s panic and snooze.',
            title: 'The Diamond Dogs',
            writer: 'Jason Sudeikis, Brendan Hunt, Joe Kelly',
            biscuitsWithBossMoment: 'Ted and Rebecca have an honest conversation about trust.',
            memorableMoments: [
                'First Diamond Dogs meeting',
                'The famous dart scene with Rupert',
                'Be curious, not judgmental speech',
            ],
            usViewersMillions: 1.42,
            viewerRating: 9.1,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Episode::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->episodes->retrieve('episode_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Episode::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->episodes->update('episode_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Episode::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $page = $this->client->episodes->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkipLimitPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Episode::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->episodes->delete('episode_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetWisdom(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->episodes->getWisdom('episode_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsArray($result);
    }

    #[Test]
    public function testListBySeason(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $page = $this->client->episodes->listBySeason(0);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkipLimitPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Episode::class, $item);
        }
    }
}

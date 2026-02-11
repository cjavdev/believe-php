<?php

namespace Tests\Services;

use Believe\Client;
use Believe\Core\Util;
use Believe\SkipLimitPage;
use Believe\Teams\League;
use Believe\Teams\Team;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class TeamsTest extends TestCase
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

        $result = $this->client->teams->create(
            cultureScore: 70,
            foundedYear: 1895,
            league: League::PREMIER_LEAGUE,
            name: 'West Ham United',
            stadium: 'London Stadium',
            values: [
                'primaryValue' => 'Pride',
                'secondaryValues' => ['History', 'Community', 'Passion'],
                'teamMotto' => 'Forever Blowing Bubbles',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Team::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->teams->create(
            cultureScore: 70,
            foundedYear: 1895,
            league: League::PREMIER_LEAGUE,
            name: 'West Ham United',
            stadium: 'London Stadium',
            values: [
                'primaryValue' => 'Pride',
                'secondaryValues' => ['History', 'Community', 'Passion'],
                'teamMotto' => 'Forever Blowing Bubbles',
            ],
            annualBudgetGbp: '150000000.00',
            averageAttendance: 59988,
            contactEmail: 'info@westhamunited.co.uk',
            isActive: true,
            nickname: 'The Hammers',
            primaryColor: '#7A263A',
            rivalTeams: ['afc-richmond', 'tottenham'],
            secondaryColor: '#1BB1E7',
            stadiumLocation: ['latitude' => 51.5387, 'longitude' => -0.0166],
            website: 'https://www.whufc.com',
            winPercentage: 52.3,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Team::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->teams->retrieve('team_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Team::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->teams->update('team_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Team::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->teams->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkipLimitPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Team::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->teams->delete('team_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetCulture(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->teams->getCulture('team_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsArray($result);
    }

    #[Test]
    public function testGetRivals(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->teams->getRivals('team_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsList($result);
    }

    #[Test]
    public function testListLogos(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->teams->listLogos('team_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsList($result);
    }
}

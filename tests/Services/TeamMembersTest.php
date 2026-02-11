<?php

namespace Tests\Services;

use Believe\Client;
use Believe\Core\Util;
use Believe\SkipLimitPage;
use Believe\TeamMembers\Coach;
use Believe\TeamMembers\Player;
use Believe\TeamMembers\Position;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class TeamMembersTest extends TestCase
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

        $result = $this->client->teamMembers->create(
            member: [
                'characterID' => 'jamie-tartt',
                'jerseyNumber' => 9,
                'position' => Position::FORWARD,
                'teamID' => 'afc-richmond',
                'yearsWithTeam' => 3,
                'memberType' => 'player',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->teamMembers->create(
            member: [
                'characterID' => 'jamie-tartt',
                'jerseyNumber' => 9,
                'position' => Position::FORWARD,
                'teamID' => 'afc-richmond',
                'yearsWithTeam' => 3,
                'assists' => 23,
                'goalsScored' => 47,
                'isCaptain' => false,
                'memberType' => 'player',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->teamMembers->retrieve('member_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->teamMembers->update('member_id', updates: []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->teamMembers->update(
            'member_id',
            updates: [
                'assists' => 0,
                'goalsScored' => 0,
                'isCaptain' => true,
                'jerseyNumber' => 1,
                'position' => Position::GOALKEEPER,
                'teamID' => 'team_id',
                'yearsWithTeam' => 0,
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->teamMembers->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkipLimitPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertNotNull($item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->teamMembers->delete('member_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testListCoaches(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->teamMembers->listCoaches();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkipLimitPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Coach::class, $item);
        }
    }

    #[Test]
    public function testListPlayers(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->teamMembers->listPlayers();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkipLimitPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Player::class, $item);
        }
    }

    #[Test]
    public function testListStaff(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $page = $this->client->teamMembers->listStaff();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkipLimitPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertNotNull($item);
        }
    }
}

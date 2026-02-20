<?php

namespace Tests\Services;

use Believe\Characters\Character;
use Believe\Characters\CharacterRole;
use Believe\Client;
use Believe\Core\Util;
use Believe\SkipLimitPage;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class CharactersTest extends TestCase
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

        $result = $this->client->characters->create(
            background: 'Legendary midfielder for Chelsea and AFC Richmond, now assistant coach. Known for his gruff exterior hiding a heart of gold.',
            emotionalStats: [
                'curiosity' => 40,
                'empathy' => 85,
                'optimism' => 45,
                'resilience' => 95,
                'vulnerability' => 60,
            ],
            name: 'Roy Kent',
            personalityTraits: ['intense', 'loyal', 'secretly caring', 'profane'],
            role: CharacterRole::COACH,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Character::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->characters->create(
            background: 'Legendary midfielder for Chelsea and AFC Richmond, now assistant coach. Known for his gruff exterior hiding a heart of gold.',
            emotionalStats: [
                'curiosity' => 40,
                'empathy' => 85,
                'optimism' => 45,
                'resilience' => 95,
                'vulnerability' => 60,
            ],
            name: 'Roy Kent',
            personalityTraits: ['intense', 'loyal', 'secretly caring', 'profane'],
            role: CharacterRole::COACH,
            dateOfBirth: '1977-03-15',
            email: 'roy.kent@afcrichmond.com',
            growthArcs: [
                [
                    'breakthrough' => 'Finding purpose beyond playing',
                    'challenge' => 'Accepting his body\'s limitations',
                    'endingPoint' => 'Retired but lost',
                    'season' => 1,
                    'startingPoint' => 'Aging footballer facing retirement',
                ],
            ],
            heightMeters: 1.78,
            profileImageURL: 'https://afcrichmond.com/images/roy-kent.jpg',
            salaryGbp: '175000.00',
            signatureQuotes: [
                'He\'s here, he\'s there, he\'s every-f***ing-where, Roy Kent!',
                'Whistle!',
            ],
            teamID: 'afc-richmond',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Character::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->characters->retrieve('character_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Character::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->characters->update('character_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Character::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $page = $this->client->characters->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SkipLimitPage::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Character::class, $item);
        }
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->characters->delete('character_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testGetQuotes(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->characters->getQuotes('character_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsList($result);
    }
}

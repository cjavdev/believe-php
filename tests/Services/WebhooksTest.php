<?php

namespace Tests\Services;

use Believe\Client;
use Believe\Core\Exceptions\WebhookException;
use Believe\Core\Util;
use Believe\Webhooks\RegisteredWebhook;
use Believe\Webhooks\WebhookNewResponse;
use Believe\Webhooks\WebhookTriggerEventResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class WebhooksTest extends TestCase
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

        $result = $this->client->webhooks->create(
            url: 'https://example.com/webhooks'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->create(
            url: 'https://example.com/webhooks',
            description: 'Production webhook for match notifications',
            eventTypes: ['match.completed', 'team_member.transferred'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookNewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->retrieve('webhook_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RegisteredWebhook::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsList($result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->delete('webhook_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsArray($result);
    }

    #[Test]
    public function testTriggerEvent(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->triggerEvent(
            eventType: 'match.completed'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookTriggerEventResponse::class, $result);
    }

    #[Test]
    public function testTriggerEventWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->webhooks->triggerEvent(
            eventType: 'match.completed',
            payload: [
                'data' => [
                    'awayScore' => 0,
                    'awayTeamID' => 'away_team_id',
                    'completedAt' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                    'homeScore' => 0,
                    'homeTeamID' => 'home_team_id',
                    'matchID' => 'match_id',
                    'matchType' => 'league',
                    'result' => 'home_win',
                    'tedPostMatchQuote' => 'ted_post_match_quote',
                    'lessonLearned' => 'lesson_learned',
                    'manOfTheMatch' => 'man_of_the_match',
                ],
                'eventType' => 'match.completed',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WebhookTriggerEventResponse::class, $result);
    }

    #[Test]
    public function testUnwrap(): void
    {
        $payload = '{"created_at":"2019-12-27T18:11:19.117Z","data":{"away_score":0,"away_team_id":"away_team_id","completed_at":"2019-12-27T18:11:19.117Z","home_score":0,"home_team_id":"home_team_id","match_id":"match_id","match_type":"league","result":"home_win","ted_post_match_quote":"ted_post_match_quote","lesson_learned":"lesson_learned","man_of_the_match":"man_of_the_match"},"event_id":"182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e","event_type":"match.completed"}';
        $this->client->webhooks->unwrap($payload);
        // unwrap successful if not error thrown, increment assertion count to avoid risky test warning
        $this->addToAssertionCount(1);
    }

    #[Test]
    public function testUnwrapBadJson(): void
    {
        $this->expectException(WebhookException::class);

        $badPayload = 'not a json string';
        $this->client->webhooks->unwrap($badPayload);
    }
}

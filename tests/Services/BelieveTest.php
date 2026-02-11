<?php

namespace Tests\Services;

use Believe\Believe\BelieveSubmitResponse;
use Believe\Client;
use Believe\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class BelieveTest extends TestCase
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
    public function testSubmit(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->believe->submit(
            situation: 'I just got passed over for a promotion I\'ve been working toward for two years.',
            situationType: 'work_challenge',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BelieveSubmitResponse::class, $result);
    }

    #[Test]
    public function testSubmitWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->believe->submit(
            situation: 'I just got passed over for a promotion I\'ve been working toward for two years.',
            situationType: 'work_challenge',
            context: 'I\'ve always tried to be a team player and support my colleagues.',
            intensity: 7,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BelieveSubmitResponse::class, $result);
    }
}

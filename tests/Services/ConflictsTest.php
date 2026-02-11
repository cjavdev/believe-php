<?php

namespace Tests\Services;

use Believe\Client;
use Believe\Conflicts\ConflictResolveResponse;
use Believe\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ConflictsTest extends TestCase
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
    public function testResolve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->conflicts->resolve(
            conflictType: 'interpersonal',
            description: 'Alex keeps taking credit for my ideas in meetings and I\'m getting resentful.',
            partiesInvolved: ['Me', 'My teammate Alex'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ConflictResolveResponse::class, $result);
    }

    #[Test]
    public function testResolveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->conflicts->resolve(
            conflictType: 'interpersonal',
            description: 'Alex keeps taking credit for my ideas in meetings and I\'m getting resentful.',
            partiesInvolved: ['Me', 'My teammate Alex'],
            attemptsMade: ['Mentioned it casually', 'Avoided them'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ConflictResolveResponse::class, $result);
    }
}

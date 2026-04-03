<?php

namespace Tests\Services\Matches;

use Believe\Client;
use Believe\Core\Util;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Tests\UnsupportedMockTests;

/**
  *
  *
 */
#[CoversNothing]
final class CommentaryTest extends TestCase
{
  protected Client $client;

  protected function setUp(): void {
    parent::setUp();

    $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
    $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);;

    $this->client = $client;
  }

  #[Test]
  public function testStream(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped('Mock server tests are disabled');
    }

    $result = $this->client->matches->commentary->stream('match_id');

    // @phpstan-ignore-next-line method.alreadyNarrowedType
    $this->assertIsNotResource($result);
  }
}
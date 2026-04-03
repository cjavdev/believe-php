<?php

namespace Tests\Services;

use Believe\Client;
use Believe\Core\Util;
use Believe\Reframe\ReframeTransformNegativeThoughtsResponse;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Tests\UnsupportedMockTests;

/**
  *
  *
 */
#[CoversNothing]
final class ReframeTest extends TestCase
{
  protected Client $client;

  protected function setUp(): void {
    parent::setUp();

    $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
    $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);;

    $this->client = $client;
  }

  #[Test]
  public function testTransformNegativeThoughts(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped('Mock server tests are disabled');
    }

    $result = $this->client->reframe->transformNegativeThoughts(
      negativeThought: 'I\'m not good enough for this job.'
    );

    // @phpstan-ignore-next-line method.alreadyNarrowedType
    $this->assertInstanceOf(
      ReframeTransformNegativeThoughtsResponse::class, $result
    );
  }

  #[Test]
  function testTransformNegativeThoughtsWithOptionalParams(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped('Mock server tests are disabled');
    }

    $result = $this->client->reframe->transformNegativeThoughts(
      negativeThought: 'I\'m not good enough for this job.', recurring: true
    );

    // @phpstan-ignore-next-line method.alreadyNarrowedType
    $this->assertInstanceOf(
      ReframeTransformNegativeThoughtsResponse::class, $result
    );
  }
}
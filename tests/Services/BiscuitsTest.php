<?php

namespace Tests\Services;

use Believe\SkipLimitPage;
use Believe\Client;
use Believe\Biscuits\Biscuit;
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
final class BiscuitsTest extends TestCase
{
  protected Client $client;

  protected function setUp(): void {
    parent::setUp();

    $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
    $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);;

    $this->client = $client;
  }

  #[Test]
  public function testRetrieve(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped('Mock server tests are disabled');
    }

    $result = $this->client->biscuits->retrieve('biscuit_id');

    // @phpstan-ignore-next-line method.alreadyNarrowedType
    $this->assertInstanceOf(Biscuit::class, $result);
  }

  #[Test]
  public function testList(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped('Mock server tests are disabled');
    }

    $page = $this->client->biscuits->list();

    // @phpstan-ignore-next-line method.alreadyNarrowedType
    $this->assertInstanceOf(SkipLimitPage::class, $page);

    if ($item = $page->getItems()[0] ?? null) {
      // @phpstan-ignore-next-line method.alreadyNarrowedType
      $this->assertInstanceOf(Biscuit::class, $item);

    }
  }

  #[Test]
  public function testGetFresh(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped('Mock server tests are disabled');
    }

    $result = $this->client->biscuits->getFresh();

    // @phpstan-ignore-next-line method.alreadyNarrowedType
    $this->assertInstanceOf(Biscuit::class, $result);
  }
}
<?php

namespace Tests\Services\Teams;

use Believe\Client;
use Believe\Core\Util;
use Believe\Teams\Logo\FileUpload;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use Tests\UnsupportedMockTests;

/**
  *
  *
 */
#[CoversNothing]
final class LogoTest extends TestCase
{
  protected Client $client;

  protected function setUp(): void {
    parent::setUp();

    $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
    $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);;

    $this->client = $client;
  }

  #[Test]
  public function testDelete(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped('Mock server tests are disabled');
    }

    $result = $this->client->teams->logo->delete(
      '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e', teamID: 'team_id'
    );

    // @phpstan-ignore-next-line method.alreadyNarrowedType
    $this->assertNull($result);
  }

  #[Test]
  function testDeleteWithOptionalParams(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped('Mock server tests are disabled');
    }

    $result = $this->client->teams->logo->delete(
      '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e', teamID: 'team_id'
    );

    // @phpstan-ignore-next-line method.alreadyNarrowedType
    $this->assertNull($result);
  }

  #[Test]
  public function testDownload(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped('Mock server tests are disabled');
    }

    $result = $this->client->teams->logo->download(
      '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e', teamID: 'team_id'
    );

    // @phpstan-ignore-next-line method.alreadyNarrowedType
    $this->assertIsNotResource($result);
  }

  #[Test]
  function testDownloadWithOptionalParams(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped('Mock server tests are disabled');
    }

    $result = $this->client->teams->logo->download(
      '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e', teamID: 'team_id'
    );

    // @phpstan-ignore-next-line method.alreadyNarrowedType
    $this->assertIsNotResource($result);
  }

  #[Test]
  public function testUpload(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped('Mock server tests are disabled');
    }

    $result = $this->client->teams->logo->upload('team_id', file: 'file');

    // @phpstan-ignore-next-line method.alreadyNarrowedType
    $this->assertInstanceOf(FileUpload::class, $result);
  }

  #[Test]
  function testUploadWithOptionalParams(): void {
    if (UnsupportedMockTests::$skip) {
        $this->markTestSkipped('Mock server tests are disabled');
    }

    $result = $this->client->teams->logo->upload('team_id', file: 'file');

    // @phpstan-ignore-next-line method.alreadyNarrowedType
    $this->assertInstanceOf(FileUpload::class, $result);
  }
}
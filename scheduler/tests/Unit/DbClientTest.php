<?php

namespace Unit;

use App\Db\DbClient;
use App\Db\ProvidesDbClient;
use App\Temperature\Temperature;
use Carbon\Carbon;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use TestCase;

class DbClientTest extends TestCase
{
    /** @test */
    public function implement_db_client_interface()
    {
        $dbClient = new DbClient;

        $this->assertInstanceOf(ProvidesDbClient::class, $dbClient);
    }

    /** @test */
    public function stores_a_temperature()
    {
        $data = [
            'temperature' => 20,
            'sensor' => 'bay',
            'createdAt' => Carbon::now()->toAtomString()
        ];

        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('post', 'http://proxy/db/temperatures', $data)
            ->willReturn(new MockResponse(json_encode(['id' => '2077'])));

        $dbClient = new DbClient($httpClient);
        $actualExpectedId = $dbClient->storeTemperature(new Temperature($data));

        $this->assertSame('2077', $actualExpectedId);
    }
}
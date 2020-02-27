<?php declare(strict_types = 1);

namespace Tests\Unit;

use App\Db\DbClient;
use App\Db\ProvidesDbClient;
use App\Temperature\Temperature;
use Carbon\Carbon;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Tests\TestCase;

class DbClientTest extends TestCase
{
    /** @test */
    public function implement_db_client_interface()
    {
        $dbClient = $this->app->make(ProvidesDbClient::class);
        $this->assertInstanceOf(DbClient::class, $dbClient);
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
            ->with('POST', 'http://proxy/db/temperatures', ['body' => $data])
            ->willReturn(new MockResponse(json_encode(['id' => '2077'])));

        $this->app->instance(HttpClientInterface::class, $httpClient);

        /** @var DbClient $dbClient */
        $dbClient = $this->app->make(ProvidesDbClient::class);

        $actualExpectedId = $dbClient->storeTemperature(new Temperature($data));

        $this->assertSame('2077', $actualExpectedId);
    }
}
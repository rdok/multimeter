<?php declare(strict_types=1);

namespace Tests\Unit;

use App\Db\DbClient;
use App\Db\InvalidDbResponse;
use App\Db\ProvidesDbClient;
use App\Temperature\Temperature;
use Carbon\Carbon;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Tests\TestCase;

class DbClientTest extends TestCase
{
    /** @test */
    public function implements_db_client_interface()
    {
        $dbClient = $this->app->make(ProvidesDbClient::class);
        $this->assertInstanceOf(DbClient::class, $dbClient);
        $this->assertInstanceOf(ProvidesDbClient::class, $dbClient);
    }

    /** @test */
    public function stores_a_temperature()
    {
        $expectedTemperatureId = '2077';
        $body = factory()->temperature()->toArray();

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->expects($this->once())
            ->method('getContent')
            ->with(true)
            ->willReturn(json_encode(['id' => $expectedTemperatureId]));

        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('POST', 'http://proxy/db/temperatures', compact('body'))
            ->willReturn($httpResponse);

        $this->app->instance(HttpClientInterface::class, $httpClient);

        /** @var DbClient $dbClient */
        $dbClient = $this->app->make(ProvidesDbClient::class);
        $actualId = $dbClient->storeTemperature(new Temperature($body));

        $this->assertSame($expectedTemperatureId, $actualId);
    }

    /** @test */
    public function validates_db_response()
    {
        $this->expectException(InvalidDbResponse::class);
        $error = ["id" => ["The id field is required."],];
        $this->expectExceptionMessage(json_encode($error));

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->expects($this->once())
            ->method('getContent')
            ->willReturn(json_encode(['invalid' => 'lorem']));

        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient
            ->expects($this->once())
            ->method('request')->willReturn($httpResponse);

        $this->app->instance(HttpClientInterface::class, $httpClient);

        /** @var DbClient $dbClient */
        $dbClient = $this->app->make(ProvidesDbClient::class);
        $dbClient->storeTemperature(factory()->temperature()->toObject());
    }
}
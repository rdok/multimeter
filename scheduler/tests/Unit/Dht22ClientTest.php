<?php

namespace Unit;

use App\Db\DbClient;
use App\Db\ProvidesDbClient;
use App\Dht22\Dht22Client;
use App\Dht22\ProvidesDht22Client;
use App\Temperature\Temperature;
use Carbon\Carbon;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Tests\TestCase;

class Dht22ClientTest extends TestCase
{
    /** @test */
    public function it_implements_dht22_client_interface()
    {
        $dht22Client = $this->app->make(Dht22Client::class);

        $this->assertInstanceOf(Dht22Client::class, $dht22Client);
        $this->assertInstanceOf(ProvidesDht22Client::class, $dht22Client);
    }

    /** @test */
    public function it_may_get_temperature_reading_from_dht22()
    {
        $data = [
            'temperature' => 20,
            'sensor' => 'bay',
            'createdAt' => Carbon::yesterday()->toAtomString()
        ];

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->expects($this->once())
            ->method('getContent')
            ->with(true)
            ->willReturn(json_encode($data));

        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient
            ->expects($this->once())
            ->method('request')
            ->with('GET', 'http://proxy/dht22/temperature')
            ->willReturn($httpResponse);

        $this->app->instance(HttpClientInterface::class, $httpClient);

        /** @var ProvidesDht22Client $dht22Client */
        $dht22Client = $this->app->make(ProvidesDht22Client::class);
        $temperature = $dht22Client->getTemperature();

        $this->assertInstanceOf(Temperature::class, $temperature);
        $this->assertSame($data, $temperature->data());
    }
}
<?php

namespace Unit;

use App\Dht22\Dht22Client;
use App\Dht22\ProvidesDht22Client;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Dht22ClientTest extends TestCase
{
    /** @test */
    public function it_implements_dht22_client_interface()
    {
        $dht22Client = new Dht22Client;

        $this->assertInstanceOf(ProvidesDht22Client::class, $dht22Client);
    }

    /** @test */
    public function it_gets_temperature_reading_from_dht22()
    {
        $this->markTestIncomplete();
//        new Temperature()
//        $httpClient = $this->createMock(HttpClientInterface::class);
//        $httpClient
//            ->expects($this->once())
//            ->method('request')
//            ->with('get', 'http://proxy/dht22')
//            ->willReturn((string) $temperature);
//
//        $dht22Client = new Dht22Client;
//
//        $actual = $dht22Client->getTemperature();

        $this->assertSame($temperature, $actual);
    }
}
<?php

namespace Unit;

use App\Db\DbClient;
use App\Db\DbClientInterface;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DbClientTest extends TestCase
{
    /** @test */
    public function implement_db_client_interface()
    {
        $dbClient = new DbClient;

        $this->assertInstanceOf(DbClientInterface::class, $dbClient);
    }

    /** @test */
    public function stores_a_temperature()
    {
        $this->markTestIncomplete();
//        $temperature = new Temperature()
        $httpClient = $this->createMock(HttpClientInterface::class);
        $httpClient->method('request')
            ->with('post', 'http://proxy/db/temperatures', [
                'temperature' => 20,
                'sensor' => 'bay',
                'createdAt' => Carbon::now()->toAtomString()
            ]);


        $dbClient = new DbClient($httpClient);
        $dbClient->storeTemperature($temperature);


    }
}
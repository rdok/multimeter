<?php

namespace tests\Feature;

use App\Command\TemperatureCommand;
use App\Db\ProvidesDbClient;
use App\Dht22\ProvidesDht22Client;
use App\Temperature\ProvidesTemperature;
use Carbon\Carbon;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\Console\Tester\CommandTester;
use TestCase;

class TemperatureCommandTest extends TestCase
{
    private array $expected;

    /** * @var ProvidesTemperature|MockObject */
    private MockObject $temperature;
    /** * @var ProvidesDbClient|MockObject */
    private $dbClient;
    /** * @var ProvidesDht22Client|MockObject */
    private $dht22Client;

    public function setUp(): void
    {
        parent::setUp();

        $this->expected = [
            'id' => 1,
            'temperature' => 20,
            'sensor' => 'bay',
            'createdAt' => Carbon::now()->toAtomString()
        ];
        $this->temperature = $this->createMock(ProvidesTemperature::class);
        $this->dbClient = $this->createMock(ProvidesDbClient::class);
        $this->dht22Client = $this->createMock(ProvidesDht22Client::class);
    }

    /** @test */
    public function store_temperature()
    {
        $this->dht22Client->expects($this->once())
            ->method('getTemperature')
            ->willReturn($this->temperature);

        $this->dbClient->expects($this->once())
            ->method('storeTemperature')
            ->with($this->temperature)
            ->willReturn($this->expected);

        $command = new TemperatureCommand($this->dht22Client, $this->dbClient);
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $this->assertStringContainsString(
            sprintf('Temperature added: %s', json_encode($this->expected)),
            $commandTester->getDisplay()
        );
    }
}
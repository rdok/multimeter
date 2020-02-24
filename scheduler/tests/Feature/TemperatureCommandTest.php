<?php

namespace tests\Feature;

use App\Command\TemperatureCommand;
use App\Db\DbClientInterface;
use App\Dht22\Dht22ClientInterface;
use App\Temperature\TemperatureInterface;
use Carbon\Carbon;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class TemperatureCommandTest extends TestCase
{
    private array $expected;

    /** * @var TemperatureInterface|MockObject */
    private MockObject $temperature;
    /** * @var DbClientInterface|MockObject */
    private $dbClient;
    /** * @var Dht22ClientInterface|MockObject */
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
        $this->temperature = $this->createMock(TemperatureInterface::class);
        $this->dbClient = $this->createMock(DbClientInterface::class);
        $this->dht22Client = $this->createMock(Dht22ClientInterface::class);
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
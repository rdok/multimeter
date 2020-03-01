<?php declare(strict_types = 1);

namespace Tests\Unit;

use App\Command\TemperatureCommand;
use Tests\TestCase;

final class AppTest extends TestCase
{
    /** @test */
    public function makes_temperature_command()
    {
       $temperatureCommand = $this->app->make(TemperatureCommand::class);

       # No exceptions thrown

       $this->assertInstanceOf(TemperatureCommand::class, $temperatureCommand);
    }
}
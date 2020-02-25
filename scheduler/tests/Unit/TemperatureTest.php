<?php

namespace Unit;

use App\Temperature\Temperature;
use App\Temperature\TemperatureException;
use App\Temperature\TemperatureInterface;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class TemperatureTest extends TestCase
{
    /** @test */
    public function implements_temperature_interface()
    {
        $temperature = new Temperature([
            "sensor" => 'lorem',
            "temperature" => 20.5,
            "createdAt" => Carbon::now()->toAtomString(),
        ]);

        $this->assertInstanceOf(TemperatureInterface::class, $temperature);
    }

    /** @test */
    public function validates_required_fields()
    {
        $this->expectException(TemperatureException::class);
        $error = [
            "sensor" => ["The sensor field is required."],
            "temperature" => ["The temperature field is required."],
            "createdAt" => ["The created at field is required."]
        ];
        $this->expectExceptionMessage(json_encode($error, true));

        new Temperature([]);
    }

    /** @test */
    public function validates_invalid_fields()
    {
        $error = [
            "temperature" => ["The temperature must be a number."],
            "createdAt" => ["The created at does not match the format Y-m-d\\TH:i:sP."]
        ];
        $this->expectExceptionMessage(json_encode($error, true));

        new Temperature([
            "sensor" => 'valid',
            "temperature" => 'invalid',
            "createdAt" => 'invalid',
        ]);
    }

    /** @test */
    public function validates_maximum_temperature()
    {
        $error = [
            "temperature" => ["The temperature may not be greater than 57.7."]
        ];
        $this->expectExceptionMessage(json_encode($error, true));

        new Temperature([
            "sensor" => 'valid',
            "temperature" => 999999,
            "createdAt" => Carbon::now()->toAtomString(),
        ]);
    }

    /** @test */
    public function validates_min_temperature()
    {
        $error = [
            "temperature" => ["The temperature must be at least -89.2."]
        ];
        $this->expectExceptionMessage(json_encode($error, true));

        new Temperature([
            "sensor" => 'valid',
            "temperature" => -999999,
            "createdAt" => Carbon::now()->toAtomString(),
        ]);
    }
}
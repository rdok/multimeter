<?php

namespace Unit;

use App\Temperature\InvalidTemperature;
use App\Temperature\ProvidesTemperature;
use App\Temperature\Temperature;
use Carbon\Carbon;
use Tests\TestCase;

class TemperatureTest extends TestCase
{
    /** @test */
    public function implements_temperature_interface()
    {
        $temperature = new Temperature([
            "sensor" => 'lorem',
            "temperature" => 20.5,
            "measuredAt" => Carbon::now()->toAtomString(),
        ]);

        $this->assertInstanceOf(ProvidesTemperature::class, $temperature);
    }

    /** @test */
    public function validates_required_fields()
    {
        $this->expectException(InvalidTemperature::class);
        $error = [
            "sensor" => ["The sensor field is required."],
            "temperature" => ["The temperature field is required."],
            "measuredAt" => ["The measured at field is required."]
        ];
        $this->expectExceptionMessage(json_encode($error, true));

        new Temperature([]);
    }

    /** @test */
    public function validates_invalid_fields()
    {
        $error = [
            "temperature" => ["The temperature must be a number."],
            "measuredAt" => ["The measured at does not match the format Y-m-d\\TH:i:sP."]
        ];
        $this->expectExceptionMessage(json_encode($error, true));

        new Temperature([
            "sensor" => 'valid',
            "temperature" => 'invalid',
            "measuredAt" => 'invalid',
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
            "measuredAt" => Carbon::now()->toAtomString(),
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
            "measuredAt" => Carbon::now()->toAtomString(),
        ]);
    }

    /** @test */
    public function converts_to_string()
    {
        $data = [
            "sensor" => 'lorem',
            "temperature" => 20.5,
            "measuredAt" => Carbon::now()->toAtomString(),
        ];

        $temperature = new Temperature($data);

        $this->assertSame($data, $temperature->toArray());
    }
}
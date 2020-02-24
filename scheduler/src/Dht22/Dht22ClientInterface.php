<?php

namespace App\Dht22;

use App\Temperature\TemperatureInterface;

interface Dht22ClientInterface
{
    public function getTemperature(): TemperatureInterface;
}
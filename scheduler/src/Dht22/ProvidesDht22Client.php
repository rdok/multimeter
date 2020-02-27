<?php declare(strict_types = 1);

namespace App\Dht22;

use App\Temperature\ProvidesTemperature;

interface ProvidesDht22Client
{
    public function getTemperature(): ProvidesTemperature;
}

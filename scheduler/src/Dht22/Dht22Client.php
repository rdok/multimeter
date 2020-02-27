<?php declare(strict_types = 1);

namespace App\Dht22;

use App\Temperature\ProvidesTemperature;

final class Dht22Client implements ProvidesDht22Client
{
    public function getTemperature(): ProvidesTemperature
    {
        // TODO: Implement getTemperature() method.
    }
}

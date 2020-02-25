<?php

namespace App\Db;

use App\Temperature\TemperatureInterface;

class DbClient implements DbClientInterface
{
    public function storeTemperature(TemperatureInterface $temperature): array
    {
        // TODO: Implement storeTemperature() method.
    }
}
<?php

namespace App\Db;

use App\Temperature\TemperatureInterface;

interface DbClientInterface
{
    public function storeTemperature(TemperatureInterface $temperature): array;
}
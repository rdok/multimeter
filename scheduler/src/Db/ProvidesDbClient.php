<?php

namespace App\Db;

use App\Temperature\ProvidesTemperature;

interface ProvidesDbClient
{
    public function storeTemperature(ProvidesTemperature $temperature): array;
}

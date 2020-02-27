<?php declare(strict_types = 1);

namespace App\Db;

use App\Temperature\ProvidesTemperature;

interface ProvidesDbClient
{
    /**
     * @param ProvidesTemperature $temperature
     * @return array<string>
     */
    public function storeTemperature(ProvidesTemperature $temperature): array;
}

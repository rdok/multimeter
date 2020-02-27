<?php declare(strict_types = 1);

namespace App\Db;

use App\Temperature\ProvidesTemperature;

interface ProvidesDbClient
{
    /**
     * @param ProvidesTemperature $temperature
     * @return string The new record id.
     */
    public function storeTemperature(ProvidesTemperature $temperature): string;
}

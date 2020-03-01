<?php declare(strict_types = 1);

namespace App\Temperature;

interface ProvidesTemperature
{
    /** @return array<string> */
    public function toArray(): array;
}

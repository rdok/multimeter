<?php declare(strict_types = 1);

namespace App\Temperature;

interface ProvidesTemperature
{
    public function data(): array;
}

<?php declare(strict_types=1);

namespace Tests\_support\factories;

use App\Temperature\Temperature;
use Faker\Generator;

final class TemperatureFactory
{
    public function __construct(Generator $generator)
    {
        $this->temperature = new Temperature([
            'sensor' => $generator->word,
            'temperature' => $generator->numberBetween(-89.2, 57.7),
            'measuredAt' => $generator->dateTime->format('Y-m-d\TH:i:sP'),
        ]);
    }

    public function toArray()
    {
        return $this->temperature->toArray();
    }

    public function toObject()
    {
        return $this->temperature;
    }
}
<?php declare(strict_types = 1);

namespace Tests\_support\factories;

use Faker\Generator;

class Factory
{
    /** * @var Generator */
    private Generator $generator;

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    public function temperature()
    {
        return (new TemperatureFactory($this->generator));
    }
}

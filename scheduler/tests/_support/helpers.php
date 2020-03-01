<?php declare(strict_types = 1);

use Tests\_support\factories\Factory;

function factory()
{
    return new Factory(\Faker\Factory::create());
}

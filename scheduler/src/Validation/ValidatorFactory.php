<?php

namespace App\Validation;

use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

class ValidatorFactory
{
    public static function make($data, $rules)
    {
        $translator = new Translator(new ArrayLoader(), 'en_US');

        $validatorFactory = new Factory($translator);

        return $validatorFactory->make(
            $data,
            $rules,
            ValidationMessages::rules()
        );
    }
}
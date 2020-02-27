<?php declare(strict_types = 1);

namespace App\Validation;

use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;

final class ValidatorFactory
{
    /**
     * @param array<string> $data
     * @param array<string> $rules
     * @return Validator
     */
    public static function make(array $data, array $rules): Validator
    {
        $translator = new Translator(new ArrayLoader(), 'en_US');

        $validatorFactory = new Factory($translator);

        return $validatorFactory->make(
            $data,
            $rules,
            include __DIR__ . '/../../resources/lang/en/validation.php'
        );
    }
}

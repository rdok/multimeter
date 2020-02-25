<?php

namespace App\Temperature;

use App\Validation\ValidatorFactory;

class Temperature implements TemperatureInterface
{
    public function __construct(array $data)
    {
        $this->validate($data);
    }

    /**
     * @param array $data
     * @throws TemperatureException
     */
    private function validate(array $data): void
    {
        $validator = ValidatorFactory::make($data, [
            'sensor' => 'required',
            'temperature' => 'required|numeric|min:-89.2|max:57.7',
            'createdAt' => 'required|date_format:Y-m-d\TH:i:sP'
        ]);

        if ($validator->fails()) {
            throw new TemperatureException($validator->errors()->toJson());
        }
    }
}
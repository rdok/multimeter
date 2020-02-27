<?php declare(strict_types = 1);

namespace App\Temperature;

use App\Validation\ValidatorFactory;

final class Temperature implements ProvidesTemperature
{
    /**
     * Temperature constructor.
     *
     * @param array<string> $data
     * @throws InvalidTemperature
     */
    public function __construct(array $data)
    {
        $this->validate($data);
    }

    /**
     * @param array<string> $data
     * @throws InvalidTemperature
     */
    private function validate(array $data): void
    {
        $validator = ValidatorFactory::make($data, [
            'sensor' => 'required',
            'temperature' => 'required|numeric|min:-89.2|max:57.7',
            'createdAt' => 'required|date_format:Y-m-d\TH:i:sP',
        ]);

        if ($validator->fails()) {
            throw new InvalidTemperature($validator->errors()->toJson());
        }
    }
}

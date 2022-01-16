<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'CurrId' => 145,
            'NumCode' => '840',
            'CharCode' => 'USD',
            'Scale' => 1,
            'Name' => 'US Dollar',
            'EnglishName' => 'US Dollar',
            'ParentCode' => 145,
        ];
    }
}


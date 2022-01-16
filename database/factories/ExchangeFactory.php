<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExchangeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'currency_id' => 1,
            'DateExch'=>now(),
            'Rate'=>0,
        ];
    }
}

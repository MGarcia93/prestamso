<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lending>
 */
class LendingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date('Ymd'),
            'lender_id' => User::all()->random()->id,
            'client_id' => Client::all()->random()->id,
            'amount_number' => $this->faker->randomFloat(2),
            'amount_word' => $this->faker->sentence(3),
            'dues_quantity' => $this->faker->numberBetween(0, 10)
        ];
    }
}

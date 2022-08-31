<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

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
        $amount = $this->faker->randomFloat(2, 2000, 120000);
        $duesQuantity = $this->faker->numberBetween(5, 10);
        $duesCurrent = $this->faker->numberBetween(1, $duesQuantity - 1);
        $date = Carbon::now()->subMonth($duesCurrent - 1)->subDay($this->faker->randomDigit());

        return [
            'date' => $date,
            'lender_id' => User::all()->random()->id,
            'client_id' => Client::all()->random()->id,
            'amount_number' => $amount,
            'amount_word' => $this->faker->sentence(3),
            'dues_quantity' => $duesQuantity,
            'dues_current' => $duesCurrent,
            'dues_amount' =>  round($amount / $duesQuantity, 2)
        ];
    }
}

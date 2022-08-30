<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'document' => $this->faker->unique()->regexify('[0-9]{8}'),
            'date_birthday' => $this->faker->date('Ymd'),
            'address' => $this->faker->streetAddress(),
            'phone' => $this->faker->unique()->regexify('[0-9]{10}'),
        ];
    }
}

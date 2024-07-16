<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name, // Generate a random name
            'address' => $this->faker->address, // Generate a random address
            'phone' => $this->faker->phoneNumber, // Generate a random phone number
            'status' => $this->faker->randomElement(['regular', 'non-regular']),
        ];
    }
}

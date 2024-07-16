<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FlowerArrangement>
 */
class FlowerArrangementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //'name'
            'name'=> fake()->name(),
            'image'=>fake()->image(),
            'type'=>fake()->text(),
            'description'=>fake()->paragraph(),
            'size' => $this->faker->randomElement(['small', 'medium', 'large']),
            'price' => $this->faker->numberBetween(10000, 1000000) / 100,
        ];
    }
}

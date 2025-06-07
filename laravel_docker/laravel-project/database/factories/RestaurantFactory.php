<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Restaurant::class;
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 100), // または randomNumber()
            'name' => fake()->word(),
            'description' => fake()->text()
        ];
    }
}

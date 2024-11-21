<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => $this->faker->word,
            'order' => $this->faker->numberBetween(1, 10),
            'color' => $this->faker->hexColor,
            'background' => $this->faker->imageUrl(),
            'icon' => $this->faker->word,
        ];
    }
}

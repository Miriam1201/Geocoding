<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\SubCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SubCategory::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'order' => $this->faker->numberBetween(1, 10),
            'category_id' => Category::factory(),
            'color' => $this->faker->safeHexColor,
            'background' => 'default_background.jpg',
            'icon' => 'default_icon.png',
        ];
    }
}

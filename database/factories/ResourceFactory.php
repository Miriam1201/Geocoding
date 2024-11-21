<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
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
            'name' => $this->faker->company,
            'description' => $this->faker->sentence,
            'category_id' => CategoryFactory::new(),
            'subcategory_id' => SubCategoryFactory::new(),
            'address' => $this->faker->address,
            'postal_code' => $this->faker->postcode,
            'state_id' => 1,
            'city_id' => 1,
            'village' => $this->faker->citySuffix,
            'phone_1' => $this->faker->phoneNumber,
            'phone_2' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'url' => $this->faker->url,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'images' => ['image1.jpg', 'image2.jpg']
        ];
    }
}

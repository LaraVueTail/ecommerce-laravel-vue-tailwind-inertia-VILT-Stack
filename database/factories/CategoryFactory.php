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
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'slug' => $this->faker->unique()->word(),
            'img'=> $this->faker->randomElement([
                "https://tailwindui.com/img/ecommerce-images/home-page-02-edition-01.jpg",
                'https://tailwindui.com/img/ecommerce-images/home-page-02-edition-02.jpg',
                "https://tailwindui.com/img/ecommerce-images/home-page-02-edition-03.jpg"
                ])
        ];
    }
}

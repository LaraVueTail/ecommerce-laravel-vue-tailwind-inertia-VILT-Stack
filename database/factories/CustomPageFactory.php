<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomPage>
 */
class CustomPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->word(),
            'slug' => $this->faker->unique()->slug(),
            'title' =>'New Page Title',
            'sub_title' =>'New Page Sub Title',
        ];
    }
}

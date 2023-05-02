<?php

namespace Database\Factories\Pages;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pages\CustomPage>
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

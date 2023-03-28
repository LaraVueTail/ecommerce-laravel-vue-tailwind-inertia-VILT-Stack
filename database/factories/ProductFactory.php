<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'category_id'=>Category::factory(),
            'thumbnail'=>null,
            'brand'=> $this->faker->word(),
            'availability'=>$this->faker->randomElement(['available', 'out_of_stock', 'coming_soon']),
            'tag'=>$this->faker->randomElement(['best_seller', 'new_arrival', 'end_of_season']),
            'inventory'=>$this->faker->randomNumber(2,50),
            'slug' => $this->faker->unique()->slug(),
            'price'=>$this->faker->randomFloat(2, 50, 70),
            'price_no_offer'=>$this->faker->randomFloat(2, 70, 100),
            'description'=>'<p>' . implode('</p><p>', $this->faker->paragraphs(6)) . '</p>',
            'short_description'=>$this->faker->paragraph(5),
            'product_details'=>'{"Color" : "Red","Material" : "Cotton","Weight": "55kg"}',
            'offer'=> $this->faker->randomElement(['30% Off', '10% Cash back', 'Flat 20USD Off'])
        ];
    }
}

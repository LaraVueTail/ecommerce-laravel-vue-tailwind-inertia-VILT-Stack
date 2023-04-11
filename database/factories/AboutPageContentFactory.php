<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AboutPageContent>
 */
class AboutPageContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'aboutHeading' =>'About Us',
            'aboutSubHeading' =>'Sub heading',
            'aboutText'=>$this->faker->paragraph(5),
            'aboutStatuses'=>json_encode([["name"=>"Years","value"=>"3"],["name"=>"Working Hours","value"=>"3000"],["name"=>"Staffs","value"=>"20"]])
        ];
    }
}

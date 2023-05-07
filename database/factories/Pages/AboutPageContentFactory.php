<?php

namespace Database\Factories\Pages;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pages\AboutPageContent>
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
            'about_heading' =>'About Us',
            'about_sub_heading' =>'Sub heading',
            'about_text'=>$this->faker->paragraph(5),
            'about_statuses'=>json_encode([["name"=>"Years","value"=>"3"],["name"=>"Working Hours","value"=>"3000"],["name"=>"Staffs","value"=>"20"]])
        ];
    }
}

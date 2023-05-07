<?php

namespace Database\Factories\Pages;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pages\ContactPageContent>
 */
class ContactPageContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'contact_heading' =>'Contact Us',
            'contact_sub_heading' =>'Sub heading',
            'contact_text'=>$this->faker->paragraph(5),
            'contact_phone_numbers'=>$this->faker->phoneNumber(),
            'contact_email'=>'contact@email.com',
            'contact_address'=>$this->faker->address()
        ];
    }
}

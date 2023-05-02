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
            'contactHeading' =>'Contact Us',
            'contactSubHeading' =>'Sub heading',
            'contactText'=>$this->faker->paragraph(5),
            'contactPhoneNumbers'=>$this->faker->phoneNumber(),
            'contactEmail'=>'contact@email.com',
            'contactAddress'=>$this->faker->address()
        ];
    }
}

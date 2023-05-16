<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'birthday' => fake()->date(),
            'gender' => fake()->randomElement(['Male','Female','Others']),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
            'address_line_1'=>fake()->streetAddress(),
            'address_line_2'=>fake()->address(),
            'city'=>fake()->city(),
            'pin_code'=>fake()->postcode(),
            'country'=>fake()->country() ,
            'email_verified_at' => now(),
            'password' => 'password', // password
            'tac' => true,
            'remember_token' => Str::random(10),
            'avatar'=>'https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

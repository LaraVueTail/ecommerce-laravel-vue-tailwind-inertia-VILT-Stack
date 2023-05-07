<?php

namespace Database\Factories\ThemeSettings;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ThemeSettings\SiteIdentity>
 */
class SiteIdentityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'site_name' => 'LaraCommerce',
            'site_domain' => 'laracommerce.com',
            'site_email' => 'official@laracommerce.com',
            'site_owner_name' => 'Ameerali C',
            'site_owner_email' => 'admin@laracommerce.com',
            'logo_image' => 'https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600',
            'banner_text' => 'New Arrivals Up to 60% Off!',
        ];
    }
}

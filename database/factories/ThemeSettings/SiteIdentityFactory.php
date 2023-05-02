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
            'siteName' => 'LaraCommerce',
            'siteDomain' => 'laracommerce.com',
            'siteEmail' => 'official@laracommerce.com',
            'siteOwnerName' => 'Ameerali C',
            'siteOwnerEmail' => 'admin@laracommerce.com',
            'logoImage' => 'https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600',
        ];
    }
}

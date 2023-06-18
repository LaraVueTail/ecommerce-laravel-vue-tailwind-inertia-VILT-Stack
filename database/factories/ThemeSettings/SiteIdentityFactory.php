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
            'site_name' => 'LVTShop',
            'site_domain' => 'ecommerce-demo.laravuetail.com',
            'site_email' => 'official@laravuetail.com',
            'site_owner_name' => 'Ameerali C',
            'site_owner_email' => 'admin@laravuetail.com',
            'logo_image' => 'https://laravuetail.com/storage/images/ecommerce-logo.svg',
            'banner_text' => 'New Arrivals Up to 60% Off!',
        ];
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\EcommerceSettings;
use App\Models\User;
use App\Models\Product;
use App\Models\ThemeSettings\SiteIdentity;
use App\Models\ThemeSettings\FooterContent;
use App\Models\Pages\HomePageContent;
use Illuminate\Database\Seeder;
use App\Models\Pages\CustomPage;
use App\Models\Pages\AboutPageContent;
use App\Models\Pages\ContactPageContent;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // ThemeOption::factory(1)->create();
        EcommerceSettings::factory(1)->create();
        CustomPage::factory(5)->create();
        SiteIdentity::factory(1)->create();
        FooterContent::factory(1)->create();
        HomePageContent::factory(1)->create();
        AboutPageContent::factory(1)->create();
        ContactPageContent::factory(1)->create();

        User::factory()->create([
            'email' => 'test@example.com'
        ]);

        User::factory()->create([
            'email' => 'admin@example.com'
        ]);

        // User::factory(5)->create();

        // Cart::factory()->create([
        //     'user_id' => 1
        // ]);

        // Cart::factory(5)->create();

        Product::factory(25)->create();
    }
}

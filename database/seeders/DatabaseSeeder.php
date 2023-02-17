<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

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


        \App\Models\User::factory()->create([
            'first_name' => 'Ameer',
            'last_name' => 'Ali',
            'email' => 'ameer@email.com'
        ]);

        Product::factory(5)->create();
    }
}

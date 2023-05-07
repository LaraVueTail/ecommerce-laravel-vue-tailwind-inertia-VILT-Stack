<?php

namespace Database\Factories\Pages;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pages\HomePageContent>
 */
class HomePageContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'hero_carousel'=> json_encode(["https://images.pexels.com/photos/5325632/pexels-photo-5325632.jpeg?auto=compress", "https://images.pexels.com/photos/5325589/pexels-photo-5325589.jpeg?auto=compress","https://images.pexels.com/photos/5325582/pexels-photo-5325582.jpeg?auto=compress","https://images.pexels.com/photos/5325701/pexels-photo-5325701.jpeg?auto=compress"])
        ];
    }
}

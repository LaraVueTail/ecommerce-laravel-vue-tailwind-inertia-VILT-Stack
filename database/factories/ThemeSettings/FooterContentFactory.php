<?php

namespace Database\Factories\ThemeSettings;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ThemeSettings\FooterContent>
 */
class FooterContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'page_links'=> json_encode([
                    [
                        'pageName'=>'About',
                        'pageLink'=>asset('about')
                    ],
                    [
                        'pageName'=>'Contact',
                        'pageLink'=>asset('contact')
                    ]
                    ]),
                    
            'social_links'=> json_encode([
                    [
                        'socialName'=>'facebook',
                        'socialLink'=>'#'
                    ],
                    [
                        'socialName'=>'instagram',
                        'socialLink'=>'#'
                    ],
                    [
                        'socialName'=>'youtube',
                        'socialLink'=>'#'
                    ],
                    [
                        'socialName'=>'whatsapp',
                        'socialLink'=>'#'
                    ]
                ])
        ];
    }
}

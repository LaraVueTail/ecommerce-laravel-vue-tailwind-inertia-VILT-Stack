<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FooterContent extends Model
{
    use HasFactory;
    protected $casts = [
        'page_links' => 'array',
        'social_links' => 'array',
    ];
    protected $appends = ['page_links','social_links'];

    protected function pageLinks():Attribute
    {
        return Attribute::make(
        get: function($value) {
                if($value === null){
                    return json_encode([
                        [
                            'pageName'=>'About',
                            'pageLink'=>asset('about')
                        ],
                        [
                            'pageName'=>'Contact',
                            'pageLink'=>asset('contact')
                        ]
                    ]);
                } else {
                    return $value;
                }
        },
        );
    }

    protected function socialLinks():Attribute
    {
        
        return Attribute::make(
        get: function($value) {
                if($value === null){
                    return json_encode([
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
                    ]);
                } else {
                    return $value;
                }
        },
        );
    }
}

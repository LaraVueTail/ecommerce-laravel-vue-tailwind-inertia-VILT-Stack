<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPageContent extends Model
{
    use HasFactory;

    protected $appends = ['about_image_url'];

    protected function aboutImage(): Attribute
    {
        
        return Attribute::make(
        set: function($value) {
                if($value === null){
                    return "https://images.pexels.com/photos/443383/pexels-photo-443383.jpeg";
                } else {
                    return $value;
                }
        },
        );
    }

    protected function aboutImageUrl():Attribute
    {
        return Attribute::make(
            get: function() {
                    return asset($this->about_image ?? '');
        });
    }
}

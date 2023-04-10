<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeOption extends Model
{
    use HasFactory;

    // protected function heroCarousel(): Attribute
    // {
    //     return Attribute::make(
    //     get: function($value) {
    //             return $value;
    //     },
    //     );
    // }

    protected function aboutImage(): Attribute
    {
        
        return Attribute::make(
        get: function($value) {
                if($value !== null){
                    return $value;
                } else {
                    return "https://images.pexels.com/photos/443383/pexels-photo-443383.jpeg";
                }
        },
        );
    }

}

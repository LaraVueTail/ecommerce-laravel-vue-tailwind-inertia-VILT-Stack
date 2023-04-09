<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeOption extends Model
{
    use HasFactory;

    protected function heroCarousel(): Attribute
    {
        return Attribute::make(
        get: function($value) {
            if(count(json_decode($value)) === 0){
                return json_encode([
                "https://images.pexels.com/photos/8774421/pexels-photo-8774421.jpeg?auto=compress",
                "https://images.pexels.com/photos/15787281/pexels-photo-15787281.jpeg?auto=compress",
                "https://images.pexels.com/photos/7324666/pexels-photo-7324666.jpeg?auto=compress"
            ]);
            } else {
                return $value;
            }
        },
        );
    }
}

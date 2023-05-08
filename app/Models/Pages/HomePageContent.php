<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePageContent extends Model
{
    use HasFactory;
    protected $appends = ['hero_carousel_url'];
    protected $casts = [
        'hero_carousel' => 'array'
    ];
    protected function heroCarousel(): Attribute
    {
        return Attribute::make(
        set: function($value){
            // dd($value);
            if(!$value){
                return json_encode(["https://images.pexels.com/photos/1549200/pexels-photo-1549200.jpeg", "https://images.pexels.com/photos/354972/pexels-photo-354972.jpeg", "https://images.pexels.com/photos/6311237/pexels-photo-6311237.jpeg"]);
            } else{
                return json_encode($value);
            }
        }
        );
    }


    protected function heroCarouselUrl():Attribute
    {
        return Attribute::make(
            get: function($value) {
                    return json_encode(array_map(fn($value): string => asset($value),json_decode($this->hero_carousel)));
        });


    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPageContent extends Model
{
    use HasFactory;

    protected $appends = ['contact_image_url'];
    protected function contactImage(): Attribute
    {

        return Attribute::make(
            set: function($value) {
                if($value === null){
                    return "https://images.pexels.com/photos/8204325/pexels-photo-8204325.jpeg";
                } else {
                    return $value;
                }
        }
        );
    }

    protected function contactImageUrl():Attribute
    {
        return Attribute::make(
            get: function() {
                    return asset($this->contactImage);
        });
    }
}

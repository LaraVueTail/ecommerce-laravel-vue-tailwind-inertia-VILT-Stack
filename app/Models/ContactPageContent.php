<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPageContent extends Model
{
    use HasFactory;
    protected function contactImage(): Attribute
    {
        
        return Attribute::make(
        get: function($value) {
                if($value !== null){
                    return $value;
                } else {
                    return "https://images.pexels.com/photos/8204325/pexels-photo-8204325.jpeg";
                }
        },
        );
    }
}

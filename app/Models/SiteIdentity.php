<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteIdentity extends Model
{
    use HasFactory;
    protected $appends = ['logo_image_url'];

    protected function logoImage(): Attribute
    {
        
        return Attribute::make(
        set: function($value) {
                if($value === null){
                    return "https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600";
                } else {
                    return $value;
                }
        },
        );
    }

    protected function logoImageUrl():Attribute
    {
        return Attribute::make(
            get: function() {
                    return asset($this->logoImage ?? '');
        });
    }

}

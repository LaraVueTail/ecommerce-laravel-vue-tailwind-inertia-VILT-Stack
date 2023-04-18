<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteIdentity extends Model
{
    use HasFactory;
    protected $appends = ['logo_image_url','enable_stripe','stripe_secret_key'];

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

    protected function enableStripe():Attribute
    {
        return Attribute::make(
            get: function() {
                    return config('ecommerce.enable_stripe');
        }
    );
    }

    protected function stripeSecretKey():Attribute
    {
        return Attribute::make(
            get: function() {
                    return config('ecommerce.stripe_secret_key');
        }
    );
    }
}

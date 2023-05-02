<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteIdentity extends Model
{
    use HasFactory;
    protected $appends = ['logo_image_url'];//,'currency_symbol','available_currencies'];

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

    // protected function currencySymbol():Attribute
    // {
    //     return Attribute::make(
    //         get: function($value) {
    //                 $currencySymbols = [
    //                     'USD' => '&#x24;',
    //                     'EUR'=>'&#x20AC;',
    //                     'JPY'=>'&#xa5;',
    //                     'INR'=>'&#x20B9;'
    //                 ];
    //                 return $currencySymbols[$this->currency] ?? 'usd';
    //     });
    // }

    // public function availableCurrencies():Attribute
    // {
    //     return Attribute::make(
    //         get: function($value) {
    //                 $currencySymbols = [
    //                     'USD' => '&#x24;',
    //                     'EUR'=>'&#x20AC;',
    //                     'JPY'=>'&#xa5;',
    //                     'INR'=>'&#x20B9;'
    //                 ];
    //                 return json_encode($currencySymbols);
    //     });
    // }
    protected function logoImageUrl():Attribute
    {
        return Attribute::make(
            get: function() {
                    return asset($this->logoImage ?? '');
        });
    }

}

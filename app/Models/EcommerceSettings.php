<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcommerceSettings extends Model
{
    use HasFactory;
    protected $appends = ['currency_symbol','available_currencies'];
    protected $casts = ['enable_stripe' => 'bool','enable_whatsapp' => 'bool'];


    protected function currencySymbol():Attribute
    {
        return Attribute::make(
            get: function($value) {
                    $currencySymbols = [
                        'USD' => '&#x24;',
                        'EUR'=>'&#x20AC;',
                        'JPY'=>'&#xa5;',
                        'INR'=>'&#x20B9;'
                    ];
                    return $currencySymbols[$this->currency] ?? 'usd';
        });
    }

    public function availableCurrencies():Attribute
    {
        return Attribute::make(
            get: function($value) {
                    $currencySymbols = [
                        'USD' => '&#x24;',
                        'EUR'=>'&#x20AC;',
                        'JPY'=>'&#xa5;',
                        'INR'=>'&#x20B9;'
                    ];
                    return json_encode($currencySymbols);
        });
    }
    
}

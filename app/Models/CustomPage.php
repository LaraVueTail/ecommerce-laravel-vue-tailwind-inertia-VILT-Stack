<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPage extends Model
{
    use HasFactory;

    protected $appends = ['image_url'];

    protected function imageUrl():Attribute
    {
        return Attribute::make(
            get: function() {
                    return asset($this->image ?? '');
        });
    }
}

<?php

namespace App\Models\Pages;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPage extends Model
{
    use HasFactory;

    protected $appends = ['image_url','page_link'];

    protected function imageUrl():Attribute
    {
        return Attribute::make(
            get: function() {
                    return asset($this->image ?? '');
        });
    }

    protected function pageLink():Attribute
    {
        return Attribute::make(
            get: function() {
                    return asset('pages/'.$this->slug);
        });
    }
}

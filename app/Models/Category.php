<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected function img(): Attribute
    {
        return Attribute::make(
        get: fn($value) => asset($value),
        );
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected function link(): Attribute
    {
        return Attribute::make(
        get: function($value) {
            $link = asset('').'shop?'.http_build_query(['categories'=>json_encode([$this->slug])]);
            return $link;
    });
    }
}

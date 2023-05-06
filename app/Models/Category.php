<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $appends = ['category_image_url','link'];

    public function scopeFilter($query, array $filters)
    {
        $query
        ->when(
            $filters['search'] ?? false,
            fn($query, $search) =>
            $query->where(fn($query) =>
                $query
                    ->where('name', 'like', "%{$search}%")
                        ->orWhere('id', '=', $search)))
        ->when(
            true,
            function ($query) {
                    $query->latest();
            }
        );
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected function categoryImageUrl():Attribute
    {
        return Attribute::make(
            get: function() {
                    return asset($this->img ?? '');
        });
    }

    protected function link(): Attribute
    {
        return Attribute::make(
        get: function($value) {
            $link = asset('').'shop?'.http_build_query(['category'=>json_encode([$this->slug])]);
            return $link;
    });
    }
}

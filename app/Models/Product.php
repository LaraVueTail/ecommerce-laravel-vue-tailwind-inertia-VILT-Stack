<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;
    protected $with = ['category'];
    protected $appends = ['thumbnail_url','more_images_url','link'];

    protected $casts = [
        'more_images' => 'array'
    ];
    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query
        ->when(
            $filters['search'] ?? false,fn($query, $search) =>
            $query
                ->where(fn($query) =>
                $query
                    ->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                            ->orWhere('short_description', 'like', "%{$search}%")
                                ->orWhere('id', '=', $search)
            )
            )
                    
                              
        ->when(
            $filters['category'] ?? false, fn($query, $categories) =>
                    $query
                        ->whereHas(
                            'category', fn($query) =>
                            $query
                                ->whereIn('slug', json_decode($categories))
                    )
                    )

        ->when($filters['tag'] ?? false, fn($query, $tags) =>
            $query
                ->whereIn('tag', json_decode($tags))
        
        )

        ->when($filters['availability'] ?? false, fn($query, $availability) =>
            $query
                ->whereIn('availability', json_decode($availability))
    
        )

        ->when($filters['brand'] ?? false, fn($query, $brands) =>
            $query
                ->whereIn('brand', json_decode($brands))
    
        )


        ->when($filters['dateStart'] ?? false, function ($query, $dateStart) {
                $dateStart = Carbon::createFromFormat('m/d/Y', $dateStart)->format('Y-m-d');
                $query
                    ->whereDate('created_at', '>=', $dateStart);
            }
        )

        ->when(
            $filters['dateEnd'] ?? false,
            function ($query, $dateEnd) {
                $dateEnd = Carbon::createFromFormat('m/d/Y', $dateEnd)->format('Y-m-d');
                $query
                    ->whereDate('created_at', '<=', $dateEnd);
            }
        )

        ->when(
            $filters['sortBy'] ?? 'default',
            function ($query, $sortBy) {
                if ($sortBy === 'date-dsc') {
                    $query->latest();
                }
                if ($sortBy === 'date-asc') {
                    $query->oldest();
                }
                if ($sortBy === 'price-dsc') {
                    $query->orderBy('price', 'desc');
                }
                if ($sortBy === 'price-asc') {
                    $query->orderBy('price', 'asc');
                }
                if ($sortBy === 'inventory-asc') {
                    $query->orderBy('inventory', 'asc');
                }
                if ($sortBy === 'inventory-dsc') {
                    $query->orderBy('inventory', 'dsc');
                }
                if ($sortBy === 'default') {
                    $query->latest();
                }
            }
        )

        ->when(
            $filters['minPrice'] ?? false, 
            fn($query, $minPrice) =>
                $query
                ->where('price', '>=', $minPrice))

        ->when(
            $filters['maxPrice'] ?? false, 
            fn($query, $maxPrice) =>
                $query
                ->where('price', '<=', $maxPrice));

    }

    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
        get: fn($value) => asset($this->thumbnail ?? ''),
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function moreImages(): Attribute
    {
        return Attribute::make(
        set: function($value){
                return json_encode($value);
        }
        );
    }

    protected function moreImagesUrl():Attribute
    {
        // dd($this->more_images);
        return Attribute::make(
            get: function($value) {
                    return json_encode(array_map(fn($value): string => asset($value ?? ''),$this->more_images));
        });


    }

    protected function link(): Attribute
    {
        return Attribute::make(
        get: fn($value) => asset("/products/". $this->slug)
        );
    }

}
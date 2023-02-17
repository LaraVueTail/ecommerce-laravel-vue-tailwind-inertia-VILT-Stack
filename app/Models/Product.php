<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;
    protected $with = ['category'];

    protected $guarded = [];

    protected function thumbnail(): Attribute   
    {
        return Attribute::make(
            get:fn($value) => Storage::url($value),
        );
    }

    public function getId() {
        return $this->username;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function link(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => env('APP_URL').'/products/'.$this->id
        );
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected function cartData(): Attribute
    {
        return Attribute::make(
            set: fn($value) => json_encode($value),
            get: fn($value) => json_decode($value)
        );
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}

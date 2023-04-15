<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

use Darryldecode\Cart\CartCollection;
use Illuminate\Database\Eloquent\Casts\Attribute;




class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query
        ->when(
            $filters['search'] ?? false,
            fn($query, $search) =>
                        $query
                            ->where('email', 'like', "%{$search}%")
                            ->orWhere('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('phone_number', '=', $search)
                            ->orWhere('id', '=', $search)
                    
        )
                    
        ->when(
            $filters['dateStart'] ?? false, 
            function ($query, $dateStart) {
                $dateStart = Carbon::createFromFormat('m/d/Y', $dateStart)->format('Y-m-d');
                $query->whereDate('created_at', '>=', $dateStart);
            }
        )
        ->when(
            $filters['dateEnd'] ?? false,
            function ($query, $dateEnd) {
                $dateEnd = Carbon::createFromFormat('m/d/Y', $dateEnd)->format('Y-m-d');
                $query->whereDate('created_at', '<=', $dateEnd);
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
        );
    }

    protected function avatar(): Attribute
    {
        return Attribute::make(
        get: fn($value) => asset($value),
        );
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


}

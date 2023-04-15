<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $hidden = ['session_id'];

    protected $with = ['user'];

    public function scopeFilter($query, array $filters)
    {
        $query
        ->when(
            $filters['search'] ?? false,
            fn($query, $search) =>
            $query->where(fn($query) =>
                $query
                    ->whereHas(
                        'user', fn($query) =>
                        $query
                            ->where('email', 'like', "%{$search}%")
                            ->orWhere('phone_number', '=', $search)
                    )->orWhere('id', '=', $search)))
        ->when(
            $filters['orderStatus'] ?? false,
            fn($query, $filter) =>
                $query
                    ->whereIn('status', json_decode($filter)))
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
                    $query->orderBy('total_price', 'desc');
                }
                if ($sortBy === 'price-asc') {
                    $query->orderBy('total_price', 'asc');
                }
                if ($sortBy === 'default') {
                    $query->latest();
                }
            }
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}

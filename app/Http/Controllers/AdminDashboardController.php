<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Support\Facades\Request;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('AdminDashboard/Index');
    }
    public function orders()
    {
        return Inertia::render('AdminDashboard/Orders', [
            'orders' => Order::query()
                ->when(Request::input('search') ?? false, fn($query, $search) => 
                    $query->where(fn($query) =>
                    $query
                    ->whereHas('user',fn($query) =>
                        $query
                        ->where('email', 'like', "%{$search}%")
                        ->orWhere('phone_number', '=', $search)
                    )
                    ->orWhere('id', '=', $search))
                )
                ->paginate(10)
                ->withQueryString(),
            'filters' => Request::only(['search'])
        ]
        );

    }
}

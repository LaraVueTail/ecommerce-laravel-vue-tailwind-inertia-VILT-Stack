<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        return Inertia::render(
            'AdminDashboard/Orders',
            [
                'orders' => Order::query()
                    ->when(Request::input('search') ?? false,
                        fn($query, $search) =>
                        $query->where(fn($query) =>
                            $query
                    ->whereHas(
                        'user', fn($query) =>
                        $query
                    ->where('email', 'like', "%{$search}%")
                    ->orWhere('phone_number', '=', $search)
                    )
                    ->orWhere('id', '=', $search)
                    )
                    )
                                
                    ->when(Request::input('orderStatus') ?? false, fn($query, $filter) => // dd(json_decode($filter))
                        $query->whereIn('status', json_decode($filter)))
                        
                    ->when(Request::input('dateStart') ?? false, function ($query, $dateStart) {
                        // dd($dateStart);
                        $dateStart = Carbon::createFromFormat('m/d/Y', $dateStart)->format('Y-m-d');
                        $query->whereDate('created_at', '>=', $dateStart);
                    }
                    )
                    ->when(
                        Request::input('dateEnd') ?? false,
                        function ($query, $dateEnd) {
                            // dd($dateEnd);
                            $dateEnd = Carbon::createFromFormat('m/d/Y', $dateEnd)->format('Y-m-d');
                            $query->whereDate('created_at', '<=', $dateEnd);
                    }
                    )
                    ->when(
                        Request::input('sortBy') ?? 'default',
                        function ($query, $sortBy) {
                            // dd($dateStart)
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
                    )
                    ->paginate(10)
                    ->withQueryString(),
                'filters' => Request::only(['search', 'sortBy', 'orderStatus', 'dateStart', 'dateEnd'])
            ]
        );

    }
}
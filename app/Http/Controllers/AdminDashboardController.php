<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Inertia\Inertia;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('AdminDashboard/Index');
    }
    public function orders()
    {
        return Inertia::render('AdminDashboard/Orders',[
            'orders' => Order::paginate(3)
        ]);
        
    }
}

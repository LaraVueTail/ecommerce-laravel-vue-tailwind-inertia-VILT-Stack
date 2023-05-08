<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Request;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CustomerDashboardController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Public/CustomerDashboard/Index',[
            'user' => Auth::user()
        ]);
    }

    public function address()
    {
        return Inertia::render('Public/CustomerDashboard/Address',[
            'user' => auth()->user()
        ]);
    }

    public function orders(Request $request)
    {   $orders = Order::filter(request(['search', 'orderStatus','dateStart','dateEnd','sortBy']))->where('user_id','=',Auth::user()->id)
        ->paginate(10);
        $data=$orders;
        $orders = $orders->makeHidden(['user']);
        $data->data = $orders;
        return Inertia::render('Public/CustomerDashboard/Orders',[
            'orders' => $data,
            'filters' => Request::only(['search', 'sortBy', 'orderStatus', 'dateStart', 'dateEnd'])
        ]);
        
    }

    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            '*'=>'required'
        ]);
        $user->update($attributes);
        return back();
    }
}

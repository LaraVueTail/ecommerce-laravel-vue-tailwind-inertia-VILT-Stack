<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use IntlChar;

class CustomerDashboardController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('CustomerDashboard/ProfileInfo',[
            'userInfo' => auth()->user()
        ]);
    }

    public function address()
    {
        return Inertia::render('CustomerDashboard/AddressInfo',[
            'userInfo' => auth()->user()
        ]);
    }

    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            '*'=>'required'
        ]);
        // dd($attributes);
        $user->update($attributes);
        return back();
    }
}

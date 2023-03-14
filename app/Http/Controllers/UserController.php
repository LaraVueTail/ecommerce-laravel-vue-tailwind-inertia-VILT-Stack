<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function login()
    {
        return Inertia::render('Auth/Login');
    }

    public function auth(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if(Auth::attempt($attributes)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success','You are logged-in');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }

    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate(
            [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'phone_number' => 'required',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:7|max:255',
            ]
            );

            Auth::login(User::create($credentials));
            return redirect('/')->with('success', 'Your account has been created.');
    }
}

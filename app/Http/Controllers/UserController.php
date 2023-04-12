<?php

namespace App\Http\Controllers;
use App\Models\MainMenu;
use Darryldecode\Cart\CartCollection;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function login()
    {
        $mainMenu = new MainMenu();
        return Inertia::render('Auth/Login',[
            'mainMenu'=>$mainMenu->publicMenu()
        ]);
    }

    public function auth(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if(Auth::attempt($attributes)){
            $request->session()->regenerate();

            $cartItems = \Cart::getContent();
            // dd($cartItems);
            if(Auth::check()) {
                \Cart::session(Auth::user()->id);
                foreach($cartItems as $row) {
                    // dd($row);
                    \Cart::add(
                        array(
                            'id' => $row['id'],
                            'name' => $row['name'],
                            'price' => $row['price'],
                            'quantity' => $row['quantity'],
                            'associatedModel' => $row['associatedModel']
                        )
                    );
                }
            }
            if(Auth::user()->can('admin')){
                return redirect()->intended('admin-dashboard')->with('success','You are logged-in');

            }
            return redirect()->intended('dashboard')->with('success','You are logged-in');
        }

        

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        \Cart::session('4yTlTDKu3oJOfzD')->clear();

 
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

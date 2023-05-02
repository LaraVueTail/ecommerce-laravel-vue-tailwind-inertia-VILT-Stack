<?php

namespace App\Http\Controllers;
use App\Models\ThemeSettings\MainMenu;
use App\Models\User;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function login()
    {
        $mainMenu = new MainMenu();
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

            $cartItems = \Cart::getContent();

            if(Auth::check()) {
                \Cart::session(Auth::user()->id);
                foreach($cartItems as $row) {
                    \Cart::add(
                        array(
                            'id' => $row['id'],
                            'name' => $row['name'],
                            'price' => $row['price'],
                            'quantity' => $row['quantity'],
                            'attributes'=>$row['attributes'],
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

            $attributes = $this->validateUser();

            Auth::login(User::create($attributes));
            return redirect('/')->with('success', 'Your account has been created.');
    }

        protected function validateUser(?User $user = null): array
    {
        $user ??= new User();

        return request()->validate([
            'first_name' => 'required|min:3|max:50',
            'last_name' => 'required|max:50',
            'avatar' => 'nullable|mimes:jpeg,png |max:2096',
            'email' => ['required','email', Rule::unique('users', 'email')->ignore($user)],
            'gender' => 'nullable',
            'birthday' => 'nullable',
            'phone_number' => 'required',
            'password' => (request()->input('password') ?? false || !$user->exists ) ? 'required|confirmed|min:6': 'nullable',
            'tac'=>'required|accepted'
        ],[
            'avatar' => 'Upload Profile image as jpg/png format with size less than 2MB',
            'tac'=>'Please agree to the Terms and Conditions!'
        ]);
    }
}

<?php

namespace App\Http\Middleware;


use Darryldecode\Cart\CartCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;




class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        if(Auth::check()){
            \Cart::session(Auth::user()->id);
        }
        return array_merge(parent::share($request), [
            'csrf_token' => csrf_token(),
            'auth' => (Auth::check()) ? ['firstName'=> Auth::user()->first_name, 'email' => Auth::user()->email ] : false,
            'cartCount' => \Cart::getTotalQuantity(),
            'cartContent' =>  \Cart::getContent(),
            'cartTotal' =>  \Cart::getTotal(),
            'flash' => [
                'message' => fn () => $request->session()->get('success')
            ],
        ]);
    }
}

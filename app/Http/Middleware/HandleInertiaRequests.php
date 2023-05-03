<?php

namespace App\Http\Middleware;

use App\Models\ThemeSettings\FooterContent;
use App\Models\ThemeSettings\MainMenu;
use App\Models\ThemeSettings\SiteIdentity;
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

        $shareData = array(
            'csrf_token' => csrf_token(),
            'logo' => SiteIdentity::first()->logoImage,
            'siteName' => SiteIdentity::first()->siteName,
            'currencySymbol'=>SiteIdentity::first()->currency_symbol,
            'auth' => (Auth::check()) ? ['firstName'=> Auth::user()->first_name, 'email' => Auth::user()->email, 'avatar' =>  Auth::user()->avatar, 'isAdmin' => Auth::user()->can('admin')] : false,
            'flash' => [
                'success' => fn () => $request->session()->get('success')
            ]);

        if(str_starts_with($request->route()->getName(), 'public')){
            $shareData = array_merge($shareData,array(
                'mainMenu' => (new MainMenu)->publicMenu(),
                'footerContent' => FooterContent::first(),
                'cartCount' => \Cart::getTotalQuantity(),
                'cartContent' =>  \Cart::getContent(),
                'cartTotal' =>  round(\Cart::getTotal(),2),
            ));
        };

        return array_merge(parent::share($request),$shareData);
    }
}

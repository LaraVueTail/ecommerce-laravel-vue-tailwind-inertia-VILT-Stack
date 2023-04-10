<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ThemeOption;
use Darryldecode\Cart\CartCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PublicPagesController extends Controller
{
    //
    public function homePage()
    {
        // dd($cart->cart_data);
        $themeOption = ThemeOption::first();
        $hero_carousel = json_decode($themeOption->hero_carousel);

        $themeOption->hero_carousel = json_encode(array_map([$this, 'getUrl'],$hero_carousel));
        return Inertia::render('Public/HomeNew', [
            'theme_option' => $themeOption,
            'products' => Product::all()
        ]);
    }

    public function singleProductPage(Product $product)
    {
        return Inertia::render('Public/SingleProduct', [
            'product' => $product
        ]);
    }

    public function shopPage()
    {
        // dd(json_decode(request('categories')));
        return Inertia::render('Public/Shop', [
            'products' => Product::filter(
                request(['categories','minPrice','maxPrice'])
            )->get(),
            'categories' => Category::all(),
            'selectedCategories' => request('categories'),
            'query'=>request()->all()
        ]);
    }
    public function getUrl($file)
    {
        return asset($file);
    }
}
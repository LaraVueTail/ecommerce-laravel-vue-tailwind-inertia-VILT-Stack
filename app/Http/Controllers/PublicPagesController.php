<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
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
        return Inertia::render('Public/HomeNew', [
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
}
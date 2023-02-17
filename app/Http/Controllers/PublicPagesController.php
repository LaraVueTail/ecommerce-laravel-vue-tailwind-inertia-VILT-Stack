<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
class PublicPagesController extends Controller
{
    //


    public function homePage()
    {
        return Inertia::render('Public/Home',[
            'products' => Product::all(),
            'cartCount' => \Cart::getTotalQuantity()
        ]);
    }

    public function singleProductPage(Product $product)
    {
        return Inertia::render('Public/SingleProduct',[
            'product' => $product
        ]);
    }

    public function shopPage()
    {
        return Inertia::render('Public/Shop',[
            'products' => Product::all()

        ]);
    }
}

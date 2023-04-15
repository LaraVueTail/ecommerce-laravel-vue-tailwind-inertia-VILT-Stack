<?php

namespace App\Http\Controllers;

use App\Models\MainMenu;
use App\Models\Product;
use Darryldecode\Cart\CartCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

// use App\Models\Cart;

class CartController extends Controller
{

    public function __construct()
    {
        $cartItems = \Cart::getContent();
        if(Auth::check()) {
            \Cart::session(Auth::user()->id);
            foreach($cartItems as $row) {
                dd($row);
                \Cart::add($row);
            }
        }
    }

    public function index()
    {
        return Inertia::render('Cart/Cart');
    }

    public function add()
    {
        $product = request()->product;
        // dd($product);
        \Cart::add(
            array(
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => request()->quantity,
                'attributes' => [
                    'image' => $product['thumbnail_url']
                ],
                'associatedModel' => $product
            )
        );
        return redirect()->back()->with('success', 'Product is Added to Cart Successfully !');
    }

    public function update(Request $request)
    {

        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        return redirect()->back();
    }

    public function remove(Request $request)
    {
        \Cart::remove($request->id);
        
        return redirect()->back();
    }
}
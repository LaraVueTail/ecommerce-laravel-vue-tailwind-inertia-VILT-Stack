<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Darryldecode\Cart\CartCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use App\Models\Cart;

class CartController extends Controller
{

    public function __construct()
    {
        if (Auth::check()) {
            \Cart::session(Auth::user()->id);
        }
    }

    public function index()
    {
        return Inertia::render('Cart/Cart');
    }

    public function add()
    {
        $product = request()->product;

        if (Auth::check()) {
            if (Cart::where('user_id', '=', Auth::user()->id)->exists()) {
                $cart = Cart::where('user_id', '=', Auth::user()->id)->first();
                dd($cart->cart_data->count());
                \Cart::add(
                    array(
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'quantity' => request()->quantity,
                        'associatedModel' => $product
                    )
                );
                // \Cart::update(
                //     $product['id'],
                //     [
                //         'quantity' => [
                //             'relative' => false,
                //             'value' => $cart->getContent($product['id']) + 1
                //         ],
                //     ]
                // );
                $cart->update([
                    'cart_count' => \Cart::getTotalQuantity(),
                    'cart_data' => \Cart::getContent(),
                ]);
            } else {
                \Cart::add(
                    array(
                        'id' => $product['id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'quantity' => request()->quantity,
                        'associatedModel' => $product
                    )
                );
                Cart::create([
                    'user_id' => Auth::user()->id,
                    'cart_count' => \Cart::getTotalQuantity(),
                    'cart_data' => \Cart::session(Auth::user()->id),
                    // 'cart_data' => \Cart::getContent(),
                ]);
            }

        } else {
            \Cart::add(
                array(
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'quantity' => request()->quantity,
                    'associatedModel' => $product
                )
            );
        }
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

        if (Auth::check()) {
            if (Cart::where('user_id', '=', Auth::user()->id)->exists()) {
                $cart = Cart::where('user_id', '=', Auth::user()->id);
                $cart->update([
                    'cart_count' => \Cart::getTotalQuantity(),
                    'cart_data' => \Cart::getContent(),
                ]);
            }

        }

        return redirect()->back();
    }

    public function remove(Request $request)
    {

        \Cart::remove($request->id);

        if (Auth::check()) {
            if (Cart::where('user_id', '=', Auth::user()->id)->exists()) {
                $cart = Cart::where('user_id', '=', Auth::user()->id);
                $cart->update([
                    'cart_count' => \Cart::getTotalQuantity(),
                    'cart_data' => \Cart::getContent(),
                ]);
            }

        }
        return redirect()->back();
    }
}
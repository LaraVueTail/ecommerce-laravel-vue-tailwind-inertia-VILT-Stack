<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    //
    public function index()
    {
        $cartContent = \Cart::getContent();
        return Inertia::render('Cart/Cart', [
            'cartContent' => $cartContent,
            'cartCount' => \Cart::getTotalQuantity(),
            'cartTotal' => \Cart::getSubTotal()
        ]);
    }
    public function add()
    {
        $product = request()->product;

        \Cart::add([
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => request()->quantity
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');

        return redirect()->back();
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

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->back();
    }

    public function remove(Request $request)
    {
        \Cart::remove($request->id);

        session()->flash('success', 'Item Cart is removed Successfully !');

        return redirect()->back();
    }
}
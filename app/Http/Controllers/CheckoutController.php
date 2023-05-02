<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use App\Models\ThemeSettings\SiteIdentity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\CartCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CheckoutController extends Controller
{
    //
    public function index()
    {
        \Cart::session(Auth::user()->id);
        $cartCount =  \Cart::getTotalQuantity();
        if($cartCount === 0){
            return redirect('/');
        }
        return Inertia::render('Checkout/Index',[
            'userInfo' => auth()->user(),
            'enable_stripe'=>SiteIdentity::first()->enable_stripe
        ]);
    }
    public function checkout(Request $request)
    {

        \Stripe\Stripe::setApiKey(config('ecommerce.stripe_secret_key'));
        
        $attributes = $request->validate([
            'shippingAddress.first_name' => 'required',
            'shippingAddress.last_name' => 'required',
            'shippingAddress.phone_number' => 'required',
            'shippingAddress.email' => 'required',
            'shippingAddress.address_line_1' => 'required',
            'shippingAddress.address_line_2' => 'required',
            'shippingAddress.city' => 'required',
            'shippingAddress.pin_code' => 'required',
            'shippingAddress.country' => 'required',
            'payment_mode'=>'required'
        ]);
        // dd($attributes);

        \Cart::session(Auth::user()->id);
        $cartContent =  \Cart::getContent();
        $cartTotal =  \Cart::getTotal();
        // dd(request()->all());
        if($attributes['payment_mode'] === 'stripe'){
            $lineItems = [];

            foreach ($cartContent as $cartItem) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => SiteIdentity::first()->currency,
                        'product_data' => [
                            'name' => $cartItem->name,
                            'images' => [$cartItem->attributes->image],
                        ],
                        'unit_amount' => $cartItem->price * 100,
                    ],
                    'quantity' => $cartItem->quantity,
                ];
            }
            $session = \Stripe\Checkout\Session::create([
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('public.checkout.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
                'cancel_url' => route('public.checkout.cancel', [], true),
            ]);
        }



        $order_items = [];
        foreach ($cartContent as $cartItem) {
            $order_items[] = [
                'id' => $cartItem->id,
                'name' => $cartItem->name,
                'price' => $cartItem->price,
                'quantity' => $cartItem->quantity,
            ];
        }
 
        $order = new Order();
        $order->status = 'unpaid';
        $order->user_id = Auth::user()->id;
        $order->shipping_address = json_encode($attributes['shippingAddress']);
        $order->cart_content = json_encode($order_items);
        $order->total_price = $cartTotal;
        $order->payment_mode = $attributes['payment_mode'];
        $order->session_id = $session->id ?? 'cash_on_delivery';
        $order->save();

        \Cart::session(Auth::user()->id)->clear();
        if($session->id ?? false){
            return Inertia::location($session->url);
        }
        return to_route('public.dashboard.orders');

    }
    public function success(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException;
            }

            $order = Order::where('session_id', $session->id)->where('status','unpaid')->first();
            $customer = User::find($order->user_id)->first_name;
            if (!$order) {
                throw new NotFoundHttpException();
            }
            if ($order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }
            return Inertia::render('Checkout/Success',['customer' => $customer]);
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }
    }
    public function cancel()
    {
        return "failed";
    }
}

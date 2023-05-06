<?php

namespace App\Http\Controllers;

use App\Models\EcommerceSettings;
use Inertia\Inertia;
use App\Models\Order;
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
            'enable_stripe'=>EcommerceSettings::first()->enable_stripe,
            'enable_whatsapp'=>EcommerceSettings::first()->enable_whatsapp,
        ]);
    }
    public function checkout(Request $request)
    {

        \Stripe\Stripe::setApiKey(EcommerceSettings::first()->stripe_secret_key);
        
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
                        'currency' => EcommerceSettings::first()->currency,
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
                'cancel_url' => route('public.checkout.cancel', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
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
        $order->session_id = $session->id ?? 'unpaid';
        $order->save();

        \Cart::session(Auth::user()->id)->clear();
        if($session->id ?? false){
            return Inertia::location($session->url);
        }
        if($attributes['payment_mode'] === 'whatsapp'){
            return Inertia::location("https://wa.me/".EcommerceSettings::first()->whatsapp_number."?text=".json_encode($order_items)."");
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
                // throw new NotFoundHttpException();
                return Inertia::render('Checkout/Cancel');

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

    public function webhook()
    {
                // This is your Stripe CLI webhook secret for testing your endpoint locally.
                $endpoint_secret = EcommerceSettings::first()->stripe_webhook_secret;

                $payload = @file_get_contents('php://input');
                $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
                $event = null;
        
                try {
                    $event = \Stripe\Webhook::constructEvent(
                        $payload, $sig_header, $endpoint_secret
                    );
                } catch (\UnexpectedValueException $e) {
                    // Invalid payload
                    return response('', 400);
                } catch (\Stripe\Exception\SignatureVerificationException $e) {
                    // Invalid signature
                    return response('', 400);
                }
        
        // Handle the event
                switch ($event->type) {
                    case 'checkout.session.completed':
                        $session = $event->data->object;
        
                        $order = Order::where('session_id', $session->id)->first();
                        if ($order && $order->status === 'unpaid') {
                            $order->status = 'paid';
                            $order->save();
                            // Send email to customer
                        }
        
                    // ... handle other event types
                    default:
                        echo 'Received unknown event type ' . $event->type;
                }
        
                return response('');
    }

    public function cancel(Request $request)
    {
        $sessionId = $request->get('session_id');
        if(!$sessionId) {
            throw new NotFoundHttpException;
        }
        return Inertia::render('Checkout/Cancel');
    }
}

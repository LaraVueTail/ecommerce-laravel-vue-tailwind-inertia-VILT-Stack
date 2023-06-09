<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Support\Facades\Request;

class AdminOrderController extends Controller
{
    //
    public function index()
    {
        return Inertia::render(
            'AdminDashboard/Orders/Index',
            [
                'orders' => Order::filter(
                    request(['search', 'orderStatus','dateStart','dateEnd','sortBy']))
                    ->paginate(10)->withQueryString(),
                'filters' => Request::only(['search', 'sortBy', 'orderStatus', 'dateStart', 'dateEnd'])
            ]
        );

    }

    public function show(Order $order)
    {

        return Inertia::render('AdminDashboard/Orders/Show', [
            'order' => $order
        ]);

    }

    public function create()
    {

        return Inertia::render('AdminDashboard/Orders/Create');

    }

    public function store()
    {

        $attributes = $this->validateOrder();

        Order::create($attributes);

        return redirect('/admin-dashboard/orders')->with('success', 'Order Created!');
    }

    public function edit(Order $order)
    {

        return Inertia::render('AdminDashboard/Orders/Edit', [
            'order' => $order
        ]);

    }

    public function update(Order $order)
    {

        $attributes = $this->validateOrder($order);

        $order->update($attributes);

        return back()->with('success', 'Order Updated!');
    }

    public function updateOrderStatus(Order $order)
    {

        $attributes = request()->validate([
            'status' => 'required',
        ]);

        $order->update($attributes);

        return back()->with('success', 'Order Updated!');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect('/admin-dashboard/orders')->with('success', 'Order Deleted!');
    }

    protected function validateOrder(?Order $post = null): array
    {
        $post ??= new Order();

        return request()->validate([
            'shipping_address' => 'required',
            'user_id' => ['required', Rule::exists('users', 'id')],
            'cart_content' => 'required',
            'payment_mode' => 'required',
            'session_id' => 'nullable',
            'status' => 'required',
            'total_price' => 'required'
        ]);
    }



}
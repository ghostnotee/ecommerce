<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('shoppingcart')
            ->whereHas('shoppingcart', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderByDesc('created_at')->get();

        return view('orders', compact('orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::with('shoppingcart.shoppingcartProducts.product')
            ->whereHas('shoppingcart', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->where('orders.id', $id)
            ->firstOrFail();

        return view('orderdetails', compact('order'));
    }
}

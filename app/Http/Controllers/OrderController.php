<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('shoppingcart')
            ->whereHas('shoppingcart', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->orderByDesc('created_at')->get();

        return view('orders', compact('orders'));
    }

    public function orderDetails($id)
    {
        $orderDetail = Order::with('shoppingcart.shoppingcart_products')
            ->whereHas('shoppingcart', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->where('order.id', $id)
            ->firstOrFail();

        return view('orderdetails');
    }
}

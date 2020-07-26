<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
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
        $order = Order::with('shoppingcart.shoppingcartProducts')
            ->where('id',$id)
            ->firstOrFail();

        return view('orderdetails',compact('order'));
    }
}

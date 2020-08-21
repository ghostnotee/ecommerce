<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('search_value')) {
            $request->flash();
            $searchValue = $request->search_value;
            $ordersList = Order::with('shoppingcart.user')
                ->where('first_name', 'like', "%$searchValue%")
                ->orWhere('last_name', 'like', "%$searchValue%")
                ->orWhere('id', $searchValue)
                ->orderByDesc('created_at')
                ->paginate(8)
                ->appends('search_value', $searchValue);
        } else {
            $ordersList = Order::with('shoppingcart.user')
                ->orderByDesc('created_at')
                ->paginate(8);
        }

        return view('admin.order.index', compact('ordersList'));
    }

    public function form($id = 0)
    {
        if ($id > 0) {
            $order = Order::with('shoppingcart.shoppingcartproducts.product')->find($id);

        }

        return view('admin.order.form', compact('order'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'status' => 'required'
        ]);

        $data = $request->only('first_name', 'last_name', 'address', 'phone', 'other_phone', 'status');

        $order = Order::where('id', $request->id)->firstOrFail();
        $order->update($data);

        return redirect()->route('admin.order.edit', $order->id)
            ->with('message', 'Güncellendi')
            ->with('message_type', 'success');
    }

    public function delete($id)
    {
        Order::destroy($id);

        return redirect()
            ->route('admin.order')
            ->with('message_type', 'success')
            ->with('message', 'Sipariş silindi');
    }
}

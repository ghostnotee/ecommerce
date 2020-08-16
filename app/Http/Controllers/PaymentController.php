<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('user.signin')
                ->with('message_type', 'info')
                ->with('message', 'Ödeme işlemi için lütfen oturum açınız.');
        } else if (count(Cart::content()) <= 0) {
            return redirect()->route('homepage')
                ->with('message_type', 'info')
                ->with('message', 'Sepetinizde ürün yok.');
        }

        $userDetail = Auth::user()->userDetail;

        return view('payment', compact('userDetail'));
    }

    public function paying(Request $request)
    {
        $order = $request->all();
        $order['shoppingcart_id'] = session('activeCartId');
        $order['bank'] = "işbank";
        $order['how_many_installments'] = 1;
        $order['status'] = "Sipariş alındı";
        $order['order_amount'] = Cart::subtotal();

        Order::create($order);
        Cart::destroy();
        session()->forget('activeCartId');

        return redirect()->route('orders')
            ->with('message_type', 'success')
            ->with('message', 'Ödeme gerçekleştirildi!');
    }
}

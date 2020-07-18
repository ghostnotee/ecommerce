<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;


class ShoppingCartController extends Controller
{
    public function index()
    {
        return view('shoppingcart');
    }

    public function addtocart()
    {
        $product = Product::find(request('id'));
        Cart::add($product->id, $product->product_name, 1, $product->price, 0, ['slug' => $product->slug]);
        return redirect()->route('shoppingcart')
            ->with('message_type', 'success')
            ->with('message', 'Ürün sepete eklendi.');
    }

    public function removefromcart($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('shoppingcart')
            ->with('message_type', 'success')
            ->with('message', 'Ürün sepetten kaldırıldı.');
    }

    public function emptythecart()
    {
        Cart::destroy();
        return redirect()->route('shoppingcart')
            ->with('message_type', 'success')
            ->with('message', 'Sepet boşaltıldı!');
    }
}

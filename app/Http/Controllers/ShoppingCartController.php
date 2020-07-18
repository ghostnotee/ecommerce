<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Validation\Validator;


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

    public function updatethecart($rowId)
    {

        /*$validator = Validator::make(request()->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);

        if ($validator->fails()) {
            session()->flash('message_type', 'danger');
            session()->flash('message', 'Adet bilgisi güncellenemedi.');
            return response()->json(['success' => false]);
        }*/

        Cart::update($rowId, request('quantity'));

        session()->flash('message_type', 'success');
        session()->flash('message', 'Adet bilgisi güncellendi.');
        return response()->json(['success' => true]);
    }
}

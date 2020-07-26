@extends('layouts.master')
@section('title','Sipariş Detayları')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sipariş (SP-{{$order->id}})</h2>
            <table class="table table-bordered table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Tutar</th>
                    <th>Adet</th>
                    <th>Ara Toplam</th>
                    <th>Durum</th>
                </tr>
                @foreach($order->shoppingcart->shoppingcartProducts as $shoppingcartProduct)

                    <tr>
                        <td style="width: 120px">
                            <img src="http://via.placeholder.com/120x100?text=Ürün_Fotoğrafı">
                        </td>
                        <td>{{$shoppingcartProduct->product->product_name }}</td>
                        <td>{{$shoppingcartProduct->price}} ₺</td>
                        <td>{{$shoppingcartProduct->quantity}}</td>
                        <td>{{$shoppingcartProduct->price * $shoppingcartProduct->quantity}} ₺</td>
                        <td>{{$shoppingcartProduct->status}}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar</th>
                    <th colspan="2">{{$order->amount}} ₺</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar (KDV'li)</th>
                    <th colspan="2">{{$order->amount*((100+config('cart.tax'))/100)}} ₺</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Sipariş Durumu</th>
                    <th colspan="2">{{$order->status}}</th>
                </tr>
            </table>
        </div>
    </div>
@endsection

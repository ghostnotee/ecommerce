@extends('layouts.master')
@section('title','Sipariş Detayları')
@section('content')
    <div class="container">
        <div class="bg-content">
            <a href="{{ route('orders') }}" class="btn btn-xs btn-primary">
                <i class="glyphicon glyphicon-arrow-left"></i>Sparişlere dön.</a>
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
                            <a href="{{ route('product', $shoppingcartProduct->product->slug) }}">
                                <img src=" {{ $shoppingcartProduct->product->details->product_photo != null ? asset('uploads/products/'.$shoppingcartProduct->product->details->product_photo) :
                                'http://via.placeholder.com/120x100?text=Ürün_Fotoğrafı'}} " style="height:120px">
                            </a>
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
                    <td colspan="2">{{$order->order_amount}} ₺</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Toplam Tutar (KDV'li)</th>
                    <td colspan="2">{{$order->order_amount * ((100+config('cart.tax'))/100)}} ₺</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Sipariş Durumu</th>
                    <td colspan="2">{{$order->status}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection

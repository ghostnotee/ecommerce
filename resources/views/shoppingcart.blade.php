@extends('layouts.master')
@section('title','Sepet Sayfası')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('layouts.partials.alert')

            @if(count(Cart::content())>0)
                <table class="table table-bordererd table-hover">
                    <tr>
                        <th colspan="2">Ürün</th>
                        <th>Adet Fiyatı</th>
                        <th>Adet</th>
                        <th>Tutar</th>
                    </tr>
                    @foreach(Cart::content() as $productCartItem)
                        <tr>
                            <td style="width: 120px;">
                                <a href="{{route('product',$productCartItem->options->slug)}}">
                                    <img src="http://via.placeholder.com/120x100?text=ÜrünResmi">
                                </a>
                            </td>
                            <td>
                                <a href="{{route('product',$productCartItem->options->slug)}}">
                                    {{$productCartItem->name}}</a>
                            </td>
                            <td>{{$productCartItem->price}} ₺</td>
                            <td>
                                <a href="#" class="btn btn-xs btn-default">-</a>
                                <span style="padding: 10px 20px">{{$productCartItem->qty}}</span>
                                <a href="#" class="btn btn-xs btn-default">+</a>
                            </td>
                            <td>{{$productCartItem->subtotal }} ₺</td>
                            <td class="text-right">
                                <a href="#">Sil</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="4" class="text-right">Alt Toplam</th>
                        <th class="text-right">{{Cart::subtotal()}} ₺</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">KDV</th>
                        <th class="text-right">{{Cart::tax()}} ₺</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Genel Toplam</th>
                        <th class="text-right">{{Cart::total()}} ₺</th>
                    </tr>
                </table>
                <div>
                    <a href="#" class="btn btn-info pull-left">Sepeti Boşalt</a>
                    <a href="#" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
                </div>
            @else
                <p>Sepetinizde ürün yok!</p>
            @endif


        </div>
    </div>
@endsection

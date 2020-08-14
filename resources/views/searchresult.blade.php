@extends('layouts.master')
@section('content')

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route('homepage')}}">Anasayfa</a></li>
            <li class="active">Arama Sonucu</li>
        </ol>
        <div class="products bg-content">
            <div class="row">
                @if(count($products)==0)
                    <div class="col-md-12 text-center">
                        Ürün bulunamadı.
                    </div>
                @endif
                @foreach($products as $product)
                    <div class="col-md-3 product">
                        <a href="{{route('product',$product->slug)}}">
                            <img src="http://via.placeholder.com/640x400?text=AramaSonucu"
                                 alt="{{$product->product_name}}">
                        </a>
                        <p>
                            <a href="{{route('product',$product->slug)}}">{{$product->product_name}}</a>
                        </p>
                        <p class="price">{{$product->price}} ₺</p>
                    </div>
                @endforeach
            </div>
            {{$products->appends(['search'=>old('search')])->links()}}
        </div>
    </div>

@endsection

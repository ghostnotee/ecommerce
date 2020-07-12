@extends('layouts.master')
@section('title', $category->category_name)
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route('homepage')}}">Anasayfa</a></li>
            <li class="active">{{$category->category_name}}</li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$category->category_name}}</div>
                    <div class="panel-body">
                        @if(count($subCategories)>0)
                            <h3>Alt Kategoriler</h3>
                            <div class="list-group categories">
                                @foreach($subCategories as $subCategory)
                                    <a href="{{route('category',$subCategory->slug)}}" class="list-group-item">
                                        <i class="fa fa-arrow-circle-right"></i>
                                        {{$subCategory->category_name}}
                                    </a>
                                @endforeach
                            </div>
                        @else Alt kategori bulunmamaktadır.
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products bg-content">
                    @if(count($products)>0)
                        Sırala
                        <a href="?order=mostselling" class="btn btn-default">Çok Satanlar</a>
                        <a href="?order=newproduct" class="btn btn-default">Yeni Ürünler</a>
                        <hr>
                    @endif
                    <div class="row">
                        @if(count($products)==0)
                            <div class="col-md-12"> Bu kategoride ürün bulunmamaktadır.</div>
                        @endif
                        @foreach($products as $product)
                            <div class="col-md-3 product">
                                <a href="{{route('product',$product->slug)}}"><img
                                        src="http://via.placeholder.com/400x400?text=ÜrünResmi"></a>
                                <p><a href="{{route('product',$product->slug)}}">{{$product->product_name}}</a></p>
                                <p class="price">{{$product->price}} ₺</p>
                                <p><a href="#" class="btn btn-theme">Sepete Ekle</a></p>
                            </div>
                        @endforeach
                    </div>
                    {{request()->has('order') ? $products->appends(['order'=>request('order')])->links() : $products->links()}}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

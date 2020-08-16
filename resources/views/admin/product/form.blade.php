@extends('admin.layouts.master')
@section('title','Ürün Yönetimi')
@section('content')

    <h1 class="page-header">Ürün Yönetimi</h1>

    <form method="post" action="{{ route('admin.product.save', $product->id) }}">
        @csrf
        <h3 class="sub-header">Ürün {{ $product->id > 0 ? 'Güncelleme' : 'Kaydetme' }} Formu</h3>

        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="product_name">Ürün Adı</label>
                    <input type="text" class="form-control" id="product_name"
                           name="product_name" placeholder="Ürün İsmi"
                           value="{{ old('product_name',$product->product_name) }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="hidden" name="original_slug" value="{{ $product->slug }}">
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug"
                           value="{{ old('slug',$product->slug) }}">
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="description">Açıklama</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Açıklama">
                        {{ old('description',$product->description) }}
                    </textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="price">Fiyatı</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Fiyatı"
                           value="{{ old('price',$product->price) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">
                    {{ $product->id > 0 ? 'Güncelle' : 'Kaydet' }}
                </button>
            </div>
        </div>
    </form>

@endsection

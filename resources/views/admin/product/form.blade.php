@extends('admin.layouts.master')
@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('title','Ürün Yönetimi')
@section('content')

    <h1 class="page-header">Ürün Yönetimi</h1>

    <form method="post" action="{{ route('admin.product.save', $product->id) }}" enctype="multipart/form-data">
        @csrf
        <h4 class="sub-header">Ürün {{ $product->id > 0 ? 'Güncelleme' : 'Kaydetme' }} Formu</h4>

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
                    <textarea class="form-control" id="description" name="description"
                              placeholder="Açıklama">{{ old('description',$product->description) }}</textarea>
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
        <div class="checkbox">
            <label>
                <input type="hidden" name="show_slider" value="0">
                <input type="checkbox" name="show_slider" value="1"
                    {{ old('show_slider', $product->details->show_slider) ? 'checked' : ''}}> Slider'da göster.
            </label>
            <label>
                <input type="hidden" name="show_opportunity_of_the_day" value="0">
                <input type="checkbox" name="show_opportunity_of_the_day" value="1"
                    {{ old('show_opportunity_of_the_day', $product->details->show_opportunity_of_the_day) ? 'checked' : ''}}>
                Günün fırsatında göster.
            </label>
            <label>
                <input type="hidden" name="show_featured" value="0">
                <input type="checkbox" name="show_featured" value="1"
                    {{ old('show_featured', $product->details->show_featured) ? 'checked' : ''}}>
                Öne çıkanda göster.
            </label>
            <label>
                <input type="hidden" name="show_most_selling" value="0">
                <input type="checkbox" name="show_most_selling" value="1"
                    {{ old('show_most_selling', $product->details->show_most_selling) ? 'checked' : ''}}>
                Çok satanda göster.
            </label>
            <label>
                <input type="hidden" name="show_damp" value="0">
                <input type="checkbox" name="show_damp" value="1"
                    {{ old('show_damp', $product->details->show_damp) ? 'checked' : ''}}>
                İndirimli ürünlerde göster.
            </label>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="categories">Kategoriler</label>
                    <select name="categories[]" id="categories" class="form-control" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ collect( old('categories',$categoriesOfProduct))->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <label class="col-md-2" for="product_photo">Ürün Fotoğrafı 🥁</label>
                <input type="file" class="col-md-3" id="product_photo" name="product_photo">
                @if($product->details->product_photo !=null)
                    <img src="/uploads/products/{{$product->details->product_photo}}"
                         style="height: 100px;margin-right: 20px" class="thumbnail">
                @endif
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
@section('footer')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.14.1/plugins/autogrow/plugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(function () {
            $('#categories').select2({
                placaholder: 'Lütfen kategori seçiniz.'
            });

            var options = {
                uiColor: '#a76c6c',
                language: 'tr',
                extraPlugins: 'autogrow',
                autoGrow_minHeight: 250,
                autoGrow_maxHeight: 600,
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl:
                    '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl:
                    '/laravel-filemanager?type=Files',
                filebrowserUploadUrl:
                    '/laravel-filemanager/upload?type=Files&_token='
            }
            CKEDITOR.replace('description', options);
        });
    </script>
@endsection

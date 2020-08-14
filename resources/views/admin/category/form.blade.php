@extends('admin.layouts.master')
@section('title','Kategori Düzenle')
@section('content')

    <h1 class="page-header">Kategori Yönetimi</h1>

    <form method="post" action="{{ route('admin.category.edit'), $user->id }}">
        @csrf
        <h3 class="sub-header">Kategory {{ $category->id > 0 ? 'Güncelleme' : 'Kaydetme' }} Formu</h3>

        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <input type="hidden" name="id" value="{{ $category->id }}">

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="category_name">Üst Kategori</label>
                    <select name="up_id" id="up_id">
                        
                    </select>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="category_name">Kategori Adı</label>
                    <input type="text" class="form-control" id="category_name" name="category_name"
                           placeholder="kategori adı"
                           value="{{ old('category_name',$category->category_name) }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="slug"
                           value="{{ old('slug',$category->slug) }}">
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-primary">
                {{ $user->id > 0 ? 'Güncelle' : 'Kaydet' }}
            </button>
        </div>
        </div>
    </form>

@endsection

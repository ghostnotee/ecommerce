@extends('admin.layouts.master')
@section('title','Kategori Yönetimi')
@section('content')

    <h1 class="page-header">Kategori Yönetimi</h1>

    <form method="post" action="{{ route('admin.category.save', $category->id )}}">
        @csrf
        <h3 class="sub-header">Kategori {{ $category->id > 0 ? 'Güncelleme' : 'Kaydetme' }} Formu</h3>

        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <input type="hidden" name="id" value="{{ $category->id }}">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="up_id">Üst Kategori</label>
                    <select name="up_id" id="up_id" class="form-control">
                        <option value="">Ana Kategori</option>
                        @foreach($categories as $categoryItem)
                            <option value="{{ $categoryItem->id }}">{{ $categoryItem->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="category_name">Kategori Adı</label>
                    <input type="text" class="form-control" id="category_name" name="category_name"
                           placeholder="kategori adı"
                           value="{{ old('category_name',$category->category_name) }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="slug"
                           value="{{ old('slug',$category->slug) }}">
                </div>
            </div>
        </div>
        <div class="row col-sm-4">
            <button type="submit" class="btn btn-primary">
                {{ $category->id > 0 ? 'Güncelle' : 'Kaydet' }}
            </button>
        </div>
    </form>

@endsection

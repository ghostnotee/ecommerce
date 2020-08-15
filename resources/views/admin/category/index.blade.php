@extends('admin.layouts.master')
@section('title','Kategori Yönetimi')
@section('content')

    <h3 class="page-header">Kullanıcı Yönetimi</h3>
    <h4 class="sub-header">Kullanıcı Listesi</h4>
    <div class="well">
        <div class="btn-group pull-right">
            <a href="{{ route('admin.category.create') }}" class="btn btn-primary ">Yeni Kategori</a>
        </div>
        <form method="post" action="{{ route('admin.category') }}" class="form-inline">
            @csrf
            <div class="form-group">
                <label for="search_value">Ara :</label>
                <input type="text" class="form-control form-control-sm" name="search_value" id="search_value"
                       placeholder="Kategori Ara..." value="{{ old('search_value') }}">
            </div>
            <button type="submit" class="btn btn-primary">Ara</button>
            <a href="{{ route('admin.category') }}" class="btn btn-warning">Temizle</a>
        </form>
    </div>

    @include('layouts.partials.alert')

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Üst Kategori</th>
                <th>Slug</th>
                <th>Kategori Adı</th>
                <th>Kayıt Tarihi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categoriesList as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->upCategory->category_name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->category_name}}</td>
                    <td>{{ $category->created_at }}</td>
                    <td style="width: 100px">
                        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-xs btn-success"
                           data-toggle="tooltip" data-placement="top"
                           title="Tooltip on top">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{ route('admin.category.delete',$category->id) }}" class="btn btn-xs btn-danger"
                           data-toggle="tooltip" data-placement="top"
                           title="Tooltip on top" onclick="return confirm('Emin misiniz?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        {{ $categoriesList->links() }}
    </div>

@endsection

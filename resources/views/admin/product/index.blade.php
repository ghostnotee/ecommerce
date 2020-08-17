@extends('admin.layouts.master')
@section('title','Ürün Yönetimi')
@section('content')

    <h3 class="page-header">Ürün Yönetimi</h3>
    <h4 class="sub-header">Ürün Listesi</h4>
    <div class="well">
        <div class="btn-group pull-right">
            <a href="{{ route('admin.product.create') }}" class="btn btn-primary ">Yeni Ürün</a>
        </div>
        <form method="post" action="{{ route('admin.product') }}" class="form-inline">
            @csrf
            <div class="form-group">
                <label for="search_value">Ara</label>
                <input type="text" class="form-control form-control-sm" name="search_value" id="search_value"
                       placeholder="Ürün Ara..." value="{{ old('search_value') }}">
            </div>
            <button type="submit" class="btn btn-primary">Ara</button>
            <a href="{{ route('admin.product') }}" class="btn btn-warning">Temizle</a>
        </form>
    </div>

    @include('layouts.partials.alert')

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Slug</th>
                <th>Ürün Adı</th>
                <th>Fiyatı</th>
                <th>Düzenle / Sil</th>
            </tr>
            </thead>
            <tbody>
            @if(count($productsList)==0)
                <tr>
                    <td colspan="6" class="text-center">Kayıt Bulunamadı</td>
                </tr>
            @endif
            @foreach($productsList as $productItem)
                <tr>
                    <td>{{ $productItem->id }}</td>
                    <td>{{ $productItem->slug }}</td>
                    <td>{{ $productItem->product_name }}</td>
                    <td>{{ $productItem->price }}</td>
                    <td style="width: 100px">
                        <a href="{{ route('admin.product.edit', $productItem->id) }}" class="btn btn-xs btn-success"
                           data-toggle="tooltip" data-placement="top"
                           title="Tooltip on top">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{ route('admin.product.delete',$productItem->id) }}" class="btn btn-xs btn-danger"
                           data-toggle="tooltip" data-placement="top"
                           title="Tooltip on top" onclick="return confirm('Emin misiniz?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        {{ $productsList->links() }}
    </div>

@endsection

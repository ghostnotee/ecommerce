@extends('admin.layouts.master')
@section('title','Sipariş Yönetimi')
@section('content')

    <h3 class="page-header">Ürün Yönetimi</h3>
    <h4 class="sub-header">Ürün Listesi</h4>
    <div class="well">
        <form method="post" action="{{ route('admin.order') }}" class="form-inline">
            @csrf
            <div class="form-group">
                <label for="search_value">Ara</label>
                <input type="text" class="form-control form-control-sm" name="search_value" id="search_value"
                       placeholder="Sipariş Ara..." value="{{ old('search_value') }}">
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
                <th>Sipariş Kodu</th>
                <th>Kullanıcı Adı</th>
                <th>Ad Soyad</th>
                <th>Tutar</th>
                <th>Durum</th>
                <th>Sipariş Tarihi</th>
                <th>Düzenle / Sil</th>
            </tr>
            </thead>
            <tbody>
            @if(count($ordersList)==0)
                <tr>
                    <td colspan="7" class="text-center">Kayıt Bulunamadı</td>
                </tr>
            @endif
            @foreach($ordersList as $order)
                <tr>
                    <td>SP-{{ $order->id }}</td>
                    <td>{{ $order->shoppingcart->user->user_name }}</td>
                    <td>{{ $order->shoppingcart->user->first_name." ".$order->shoppingcart->user->last_name }}</td>
                    <td>{{ $order->order_amount * ((100 + config('cart.tax'))/100) }} ₺</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td style="width: 100px">
                        <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-xs btn-success"
                           data-toggle="tooltip" data-placement="top"
                           title="Tooltip on top">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{ route('admin.product.delete',$order->id) }}" class="btn btn-xs btn-danger"
                           data-toggle="tooltip" data-placement="top"
                           title="Tooltip on top" onclick="return confirm('Emin misiniz?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        {{ $ordersList->links() }}
    </div>

@endsection

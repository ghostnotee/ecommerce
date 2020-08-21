@extends('admin.layouts.master')
@section('title','Sipariş Yönetimi')
@section('content')

    <h1 class="page-header">Sipariş Yönetimi</h1>

    <form method="post" action="{{ route('admin.order.save', $order->id) }}" enctype="multipart/form-data">
        @csrf
        <h4 class="sub-header">Sipariş {{ $order->id > 0 ? 'Güncelleme' : 'Kaydetme' }} Formu</h4>

        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="first_name">Adı</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Müşteri isim"
                           value="{{ old('first_name',$order->first_name) }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="last_name">Soyadı</label>
                    <input type="text" class="form-control" id="last_name" name="last_name"
                           placeholder="Müşteri soy isim" value="{{ old('last_name',$order->last_name) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                           value="{{ old('phone',$order->phone) }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="other_phone">Diğer Telefon</label>
                    <input type="text" class="form-control" id="other_phone" name="other_phone"
                           value="{{ old('phone',$order->other_phone) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="address">Adres</label>
                    <textarea class="form-control" id="address"
                              name="address">{{ old('address',$order->address) }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status">Durum</label>
                    <select name="status" id="status" class="form-control">
                        <option {{ old('status',$order->status)=='Siparişiniz alındı'?'selected':'' }}>
                            Siparişiniz alındı
                        </option>
                        <option {{ old('status',$order->status)=='Ödeme onaylandı'?'selected':'' }}>
                            Ödeme Onaylandı
                        </option>
                        <option {{ old('status',$order->status)=='Kargoya verildi'?'selected':'' }}>
                            Kargoya verildi
                        </option>
                        <option {{ old('status',$order->status)=='Sipariş tamamlandı'?'selected':'' }}>
                            Sipariş tamamlandı
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">
                    {{ $order->id > 0 ? 'Güncelle' : 'Kaydet' }}
                </button>
            </div>
        </div>
    </form>
@endsection
@section('footer')
    <script src="//cdn.ckeditor.com/4.14.1/basic/ckeditor.js"></script>
    <script>
        $(function () {
            var options = {
                language: 'tr',
                height: 100
            }
            CKEDITOR.replace('address', options);
        })
    </script>
@endsection

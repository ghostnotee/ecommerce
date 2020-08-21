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

        <h2>Sipariş (SP-{{$order->id}})</h2>
        <table class="table table-bordered table-hover">
            <tr>
                <th colspan="2">Ürün</th>
                <th>Tutar</th>
                <th>Adet</th>
                <th>Ara Toplam</th>
                <th>Durum</th>
            </tr>
            @foreach($order->shoppingcart->shoppingcartProducts as $shoppingcartProduct)
                <tr>
                    <td style="width: 120px">
                        <a href="{{ route('product', $shoppingcartProduct->product->slug) }}">
                            <img src=" {{ $shoppingcartProduct->product->details->product_photo != null ? asset('uploads/products/'.$shoppingcartProduct->product->details->product_photo) :
                                'http://via.placeholder.com/120x100?text=Ürün_Fotoğrafı'}} " style="height:120px">
                        </a>
                    </td>
                    <td>{{$shoppingcartProduct->product->product_name }}</td>
                    <td>{{$shoppingcartProduct->price}} ₺</td>
                    <td>{{$shoppingcartProduct->quantity}}</td>
                    <td>{{$shoppingcartProduct->price * $shoppingcartProduct->quantity}} ₺</td>
                    <td>{{$shoppingcartProduct->status}}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="4" class="text-right">Toplam Tutar</th>
                <td colspan="2">{{$order->order_amount}} ₺</td>
            </tr>
            <tr>
                <th colspan="4" class="text-right">Toplam Tutar (KDV'li)</th>
                <td colspan="2">{{$order->order_amount * ((100+config('cart.tax'))/100)}} ₺</td>
            </tr>
            <tr>
                <th colspan="4" class="text-right">Sipariş Durumu</th>
                <td colspan="2">{{$order->status}}</td>
            </tr>
        </table>
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

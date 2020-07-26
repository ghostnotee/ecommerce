@extends('layouts.master')
@section('title','Ödeme Sayfası')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Ödeme</h2>
            <form action="{{route('paying')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <h3>Ödeme Bilgileri</h3>
                        <div class="form-group">
                            <label for="creditcard_no">Kredi Kartı Numarası</label>
                            <input type="text" class="form-control creditcard" id="creditcard_no" name="creditcard_no"
                                   style="font-size:20px;" required>
                        </div>
                        <div class="form-group">
                            <label for="cardexpiredatemonth">Son Kullanma Tarihi</label>
                            <div class="row">
                                <div class="col-md-6">
                                    Ay
                                    <select name="cardexpiredatemonth" id="cardexpiredatemonth" class="form-control"
                                            required>
                                        <option>1</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    Yıl
                                    <select name="cardexpiredateyear" class="form-control" required>
                                        <option>2017</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cardcvv2">CVV (Güvenlik Numarası)</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control cardcvv2" name="cardcvv2" id="cardcvv2"
                                           required>
                                </div>
                            </div>
                        </div>
                        <form>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" checked> Ön bilgilendirme formunu okudum ve kabul
                                        ediyorum.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" checked> Mesafeli satış sözleşmesini okudum ve kabul
                                        ediyorum.</label>
                                </div>
                            </div>
                        </form>
                        <button type="submit" class="btn btn-success btn-lg">Ödeme Yap</button>
                    </div>
                    <div class="col-md-7">
                        <h4>Ödenecek Tutar</h4>
                        <span class="price">{{ Cart::total() }}<small>TL</small></span>
                        <h4>İletişim ve Fatura Bilgileri</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname">Ad </label>
                                    <input type="text" class="form-control" name="first_name"
                                           id="firstname"
                                           value="{{Auth::user()->first_name}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastname">Soyad</label>
                                    <input type="text" class="form-control" name="last_name"
                                           id="lastname"
                                           value="{{Auth::user()->last_name}}" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="address">Adres</label>
                                    <input type="text" class="form-control" name="address" id="address"
                                           value="{{$userDetail->address}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Telefon</label>
                                    <input type="text" class="form-control phone" name="phone" id="phone"
                                           value="{{$userDetail->phone}}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="otherphone">Diğer Telefon</label>
                                    <input type="text" class="form-control phone" name="other_phone" id="otherphone"
                                           value="{{$userDetail->other_phone}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script>
        $('.creditcard').mask('0000-0000-0000-0000', {placeholder: "____-____-____-____"});
        $('.cardcvv2').mask('000', {placeholder: "___"});
        $('.phone').mask('(000) 000-00-00', {placeholder: "(___) ___-__-__"});
    </script>
@endsection

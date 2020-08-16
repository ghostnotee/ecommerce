@extends('admin.layouts.master')
@section('title','Kullanıcı Edit')
@section('content')

    <h1 class="page-header">Kullanıcı Yönetimi</h1>

    <form method="post" action="{{ route('admin.user.save', $user->id) }}">
        @csrf
        <h3 class="sub-header">Kullanıcı {{ $user->id > 0 ? 'Güncelleme' : 'Kaydetme' }} Formu</h3>
        @include('layouts.partials.errors')
        @include('layouts.partials.alert')
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="first_name">Ad</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="İsim"
                           value="{{ old('first_name',$user->first_name) }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="last_name">Soyad</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Soyad"
                           value="{{ old('last_name',$user->last_name) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="user_name">Kullanıcı Adı</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="kullanıcı adı"
                           value="{{old('user_name',$user->user_name) }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="email">e mail</label>
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="email" class="form-control" id="email" name="email" placeholder="abc@abc.com"
                               value="{{old('email',$user->email) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Şifre</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="şifre">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Adres"
                           value="{{ old('address',$user->userDetail->address) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefon"
                           value="{{ old('phone',$user->userDetail->phone) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="other_phone">Diğer Telefon</label>
                    <input type="text" class="form-control" id="other_phone" name="other_phone"
                           placeholder="Diğer Telefon"
                           value="{{ old('other_phone',$user->userDetail->other_phone) }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label>
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1"
                        {{ old('is_active',$user->is_active) ? "checked" : null}}> Aktif Mi ?
                </label>
            </div>
            <div class="col-md-2">
                <label>
                    <input type="hidden" name="is_admin" value="0">
                    <input type="checkbox" name="is_admin" value="1"
                        {{ old('is_admin', $user->is_admin) ? "checked" : null}}> Yönetici Mi ?
                </label>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">
                    {{ $user->id > 0 ? 'Güncelle' : 'Kaydet' }}
                </button>
            </div>
        </div>
    </form>

@endsection

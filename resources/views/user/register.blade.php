@extends('layouts.master')
@section('title','Kayıt Ol!')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @include('layouts.partials.errors')
                    <div class="panel-heading">Kaydol</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{route('user.register')}}">
                            @csrf
                            <div class="form-group {{$errors->has('first_name')?'has-error':''}}">
                                <label for="first_name" class="col-md-4 control-label">Ad</label>
                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control" name="first_name"
                                           value="{{old('first_name')}}"
                                           required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="last_name" class="col-md-4 control-label">Soyad</label>
                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" name="last_name"
                                           value="{{old('last_name')}}"
                                           required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user_name" class="col-md-4 control-label">Kulanıcı Adı</label>
                                <div class="col-md-6">
                                    <input id="user_name" type="text" class="form-control" name="user_name"
                                           value="{{old('user_name')}}"
                                           required autofocus>
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('email') ? 'has-error':''}}">
                                <label for="email" class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{old('email')}}" required>
                                    @if($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{$errors->first('email')}}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group {{$errors->has('password') ? 'has-error':''}}">
                                <label for="password" class="col-md-4 control-label">Şifre</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control"
                                           name="password" required>
                                </div>
                            </div>

                            <div class="form-group {{$errors->has('password') ? 'has-error':''}}">
                                <label for="password-confirm" class="col-md-4 control-label">Şifre (Tekrar)</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Kaydol
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

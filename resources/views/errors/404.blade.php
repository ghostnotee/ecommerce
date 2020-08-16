@extends('layouts.master')
@section('content')
    <div class="jumbotron text-center">
        <h1>Hay aksi</h1>
        <h2>Aradığınız sayfa bulunamadı.</h2>
        <a href="{{route('homepage')}}" class="btn btn-primary">Ana sayfaya dön.</a>
    </div>
@endsection

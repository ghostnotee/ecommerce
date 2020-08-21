@extends('admin.layouts.master')
@section('title','Anasayfa')
@section('content')
    <h1 class="page-header">Kontrol Paneli</h1>

    <section class="row text-center placeholders">
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Bekleyen Sipariş</div>
                <div class="panel-body">
                    <h4>{{ $statistics['pendingOrder'] }}</h4>
                    <p>adet</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Tamamlanan Sipariş</div>
                <div class="panel-body">
                    <h4>123</h4>
                    <p>Data</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Ürün</div>
                <div class="panel-body">
                    <h4>123</h4>
                    <p>Data</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Header</div>
                <div class="panel-body">
                    <h4>123</h4>
                    <p>Data</p>
                </div>
            </div>
        </div>
    </section>
@endsection

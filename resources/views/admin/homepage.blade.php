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
                    <h4>{{$statistics['complatedOrder']}}</h4>
                    <p>adet</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Ürün</div>
                <div class="panel-body">
                    <h4>{{$statistics['totalProduct']}}</h4>
                    <p>adet</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Kullanıcı</div>
                <div class="panel-body">
                    <h4>{{$statistics['totalUser']}}</h4>
                    <p>adet</p>
                </div>
            </div>
        </div>
    </section>

    <section class="row">
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Çok Satan Ürünler</div>
                <div class="panel-body">
                    <canvas id="chartMostSelling"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Aylara Göre Satışlar</div>
                <div class="panel-body">
                    <canvas id="chartSalesByMonth"></canvas>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script>
        @php
            $labels="";
            $data="";
            foreach ($mostSellingProducts as $product) {
                $labels .= "\"$product->product_name\", ";
                $data .= "$product->quantity, ";
            }
        @endphp

        var ctx = document.getElementById('chartMostSelling').getContext('2d');
        var chartMostSelling = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: [{!! $labels !!}],
                datasets: [{
                    label: 'Çok Satan Ürünler',
                    data: [{!! $data !!}],
                    borderColor: 'rgb(255,99,132)',
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    position: 'bottom',
                    display: false
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }
        });

        @php
            $labels="";
            $data="";
            foreach ($salesByMonth as $sales) {
                $labels .= "\"$sales->month\", ";
                $data .= "$sales->quantity, ";
            }
        @endphp

        var ctx2 = document.getElementById('chartSalesByMonth').getContext('2d');
        var chartSalesByMonth = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: [{!! $labels !!}],
                datasets: [{
                    label: 'Aylara Göre Satışlar',
                    data: [{!! $data !!}],
                    borderColor: 'rgb(255,99,132)',
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    position: 'bottom'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                }
            }
        });
    </script>
@endsection

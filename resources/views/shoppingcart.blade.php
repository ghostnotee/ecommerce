@extends('layouts.master')
@section('title','Sepet Sayfası')
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('layouts.partials.alert')

            @if(count(Cart::content())>0)
                <table class="table table-bordererd table-hover">
                    <tr>
                        <th colspan="2">Ürün</th>
                        <th>Adet Fiyatı</th>
                        <th>Adet</th>
                        <th>Tutar</th>
                    </tr>
                    @foreach(Cart::content() as $productCartItem)
                        <tr>
                            <td style="width: 120px;">
                                <a href="{{route('product',$productCartItem->options->slug)}}">
                                    <img src="http://via.placeholder.com/120x100?text=ÜrünResmi">
                                </a>
                            </td>
                            <td>
                                <a href="{{route('product',$productCartItem->options->slug)}}">
                                    {{$productCartItem->name}}
                                </a>
                                <form action="{{route('shoppingcart.removefromcart',$productCartItem->rowId)}}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger btn-xs" value="Sepetten Kaldır">
                                </form>
                            </td>
                            <td>{{$productCartItem->price}} ₺</td>
                            <td>
                                <a href="#" class="btn btn-xs btn-default product-number-decrease"
                                   data-id="{{$productCartItem->rowId}}" data-quantity="{{$productCartItem->qty-1}}">
                                    -
                                </a>
                                <span style="padding: 10px 20px">{{$productCartItem->qty}}</span>
                                <a href="#" class="btn btn-xs btn-default product-number-increase"
                                   data-id="{{$productCartItem->rowId}}" data-quantity="{{$productCartItem->qty+1}}">
                                    +
                                </a>
                            </td>
                            <td>{{$productCartItem->subtotal }} ₺</td>
                            <td class="text-right">
                                <a href="#">Sil</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="4" class="text-right">Alt Toplam</th>
                        <th class="text-right">{{Cart::subtotal()}} ₺</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">KDV</th>
                        <th class="text-right">{{Cart::tax()}} ₺</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Genel Toplam</th>
                        <th class="text-right">{{Cart::total()}} ₺</th>
                    </tr>
                </table>
                <form action="{{route('shoppingcart.emptythecart')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-info pull-left" value="Sepeti Boşalt">
                </form>
                <a href="#" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
            @else
                <p>Sepetinizde ürün yok!</p>
            @endif


        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(function () {
            setTimeout(function () {
                $('.alert').slideUp("slow");
            }, 3000);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.product-number-increase, .product-number-decrease').on('click', function () {
                var id = $(this).attr('data-id');
                var quantity = $(this).attr('data-quantity');
                $.ajax({
                    type: 'PATCH',
                    url: '{{url('shoppingcart/updatethecart')}}/' + id,
                    data: {quantity: quantity},
                    success: function () {
                        window.location.href = '{{route('shoppingcart')}}';
                    }
                });
            });
        });
    </script>
@endsection

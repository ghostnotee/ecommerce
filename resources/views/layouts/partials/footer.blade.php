<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">Ecommerce Sample &copy; @php echo date('Y') @endphp</div>
            <div class="col-md-6 text-right"><a href="#">Selçuk Bilgen Essays</a></div>
        </div>
    </div>
</footer>
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

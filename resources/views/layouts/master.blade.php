<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title',config('app.name'))</title>
    @include('layouts.partials.head')
    @yield('head')
</head>

<body id="commerce">
{{------TopNavBar --}}
@include('layouts.partials.navbar')

{{------Content------}}
@yield('content')

{{------Footer------}}
@include('layouts.partials.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/public/js/master.js"></script>
@yield('footer')
</body>

</html>

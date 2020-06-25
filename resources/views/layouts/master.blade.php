<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title',config('app.name'))</title>
</head>
<body>

{{------TopNavBar------}}
@include('layouts.partials.navbar')

{{------Content------}}
@yield('content')
<hr>
Laravel Eticaret

{{------Footer------}}
@include('layouts.partials.footer', ['year'=> date('Y')])

</body>
</html>

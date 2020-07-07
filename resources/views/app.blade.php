<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @auth
        <meta name="api-token" content="{{\Illuminate\Support\Facades\Auth::user()->api_token}}">
    @endauth
    <title>سامانه سفارش غذا</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/vendor/PersianDatePicker/jquery.md.bootstrap.datetimepicker.style.css')}}">
    @stack('css')
</head>
<body>
@include('components.popup')
<div id="main" style="background-image: url('{{asset('assets/images/dashboard-bg.jpg')}}');background-size: cover">
    @yield('content')
</div>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('assets/vendor/PersianNumber/persianumber.min.js')}}"></script>
<script src="{{asset('assets/vendor/PersianDatePicker/jquery.md.bootstrap.datetimepicker.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#popup-Modal").modal('toggle');
    });
</script>
@stack('js')
</body>
</html>

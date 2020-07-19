<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="server-address" content="{{request()->getSchemeAndHttpHost()}}">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @auth
        <meta name="api-token" content="{{\Illuminate\Support\Facades\Auth::user()->api_token}}">
    @endauth
    <title>سامانه سفارش غذا</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/vendor/PersianDatePicker/jquery.md.bootstrap.datetimepicker.style.css')}}">
    <style>
        #loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1051;
            background-color: #1d2124;
            opacity: 0.8;
            display: none;
        }

        .lds-ring {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-ring div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 64px;
            height: 64px;
            margin: 8px;
            border: 8px solid #fff;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: #fff transparent transparent transparent;
        }

        .lds-ring div:nth-child(1) {
            animation-delay: -0.45s;
        }

        .lds-ring div:nth-child(2) {
            animation-delay: -0.3s;
        }

        .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
        }

        @keyframes lds-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    @stack('css')
</head>
<body>
@include('components.loading')
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

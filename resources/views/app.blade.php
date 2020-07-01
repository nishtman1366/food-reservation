<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @auth
        <meta name="api-token" content="{{\Illuminate\Support\Facades\Auth::user()->api_token}}">
    @endauth
    <title>ریخته گری دقیق پارس</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    @stack('css')
</head>
<body>
<div id="status-bar" class="row p-sm-1">
    <div class="col-sm-12 col-md-9">
        {{-- Calendar --}}
        <i class="icon-16 icon-white" data-feather="calendar"></i>
        <p class="font-size-extra-small m-0 d-inline-block text-white">{{$data['date']['jDate']}}
            | {{$data['date']['gDate']}}</p>

        {{-- Time --}}
        <div id="time-container" class="d-inline-block">
            <i class="icon-16 icon-white" data-feather="clock"></i>
            <p id="time" class="font-size-extra-small m-0 d-inline-block text-white"></p>
        </div>
    </div>

    <div class="col-sm-12 col-md-3 text-sm-left mt-2 mt-md-0">

    </div>
</div>
<nav id="app-bar" class="navbar navbar-expand-lg navbar-light shadow-sm">
    {{--Logo--}}
    <a class="navbar-brand m-0" href="/">
        <img id="logo" src="{{ url("/assets/images/logo.png") }}"/>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        {{-- Menus --}}
        <ul class="navbar-nav ml-auto mr-sm-4">
            <li class="nav-item font-size-normal dropdown">
                <a class="nav-link app-bar-menu-item" href="{{route('dashboard')}}" role="button">
                    صفحه اصلی
                </a>
            </li>
            <li class="nav-item font-size-normal dropdown">
                <a class="nav-link dropdown-toggle app-bar-menu-item"
                   id="foods-reservation"
                   href="{{route('foods.reservation')}}"
                   role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    رزرو غذا
                </a>
                <div class="app-bar-menu dropdown-menu dropdown-menu-right" aria-labelledby="#foods-reservation">
                    <div>
                        <a class="dropdown-item text-right font-size-small"
                           href="{{route('foods.list')}}">
                            لیست غذاها
                        </a>
                    </div>
                    <div>
                        <a class="dropdown-item text-right font-size-small"
                           href="{{route('days.foods')}}">
                            مدیریت منوها
                        </a>
                    </div>
                    <div>
                        <a class="dropdown-item text-right font-size-small"
                           href="yahoo.com">
                            سفارشات
                        </a>
                    </div>
                </div>
            </li>
            <li class="nav-item font-size-normal dropdown">
                <a class="nav-link app-bar-menu-item" href="{{route('users.list')}}" role="button">
                    مدیریت کاربران
                </a>
            </li>
        </ul>
    </div>
</nav>
<div id="main">
    @yield('content')
</div>
<script src="{{asset('js/app.js')}}"></script>
@stack('js')
</body>
</html>

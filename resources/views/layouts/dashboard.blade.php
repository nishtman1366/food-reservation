@extends('app')

@section('content')
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
                @auth
                    @if(Auth::user()->level==1)
                        <li class="nav-item font-size-normal dropdown">
                            <a class="nav-link dropdown-toggle app-bar-menu-item"
                               id="foods-reservation"
                               href="{{route('foods.reservation')}}"
                               role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                رزرو غذا
                            </a>
                            <div class="app-bar-menu dropdown-menu dropdown-menu-right"
                                 aria-labelledby="#foods-reservation">
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
                                       href="{{route('reports.list')}}">
                                        گزارشات
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item font-size-normal dropdown">
                            <a class="nav-link app-bar-menu-item" href="{{route('users.list')}}" role="button">
                                مدیریت کاربران
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </nav>
    <div class="container-fluid d-flex flex-column">
        <div class="row flex-grow-1">
            <div class="col-12 col-md-3 p-1">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">{{Auth::user()->name}} خوش آمدید</h3>
                        <div class="row text-right">
                            <div class="col-12 m-1">شماره پرسنلی: {{Auth::user()->personal_code}}</div>
                            <div class="col-12 m-1">شماره ملی: {{Auth::user()->national_code}}</div>
                        </div>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button class="btn btn-primary col-12">خروج از سیستم</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <div class="card m-1">
                    <div class="card-body">
                        @yield('dashboard_content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="row m-1 p-1">
        <div class="col-12 col-md-3 m-auto">
            <a href="{{route('foods.reservation')}}">
                <div class="btn btn-success m-1 col-12" style="height: 120px">
                    <i class="fa fa-cutlery" style="font-size: 4em"></i>
                    <p class="text-center" style="font-size: 1.4em">
                        رزرو غذا
                    </p>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-3 m-auto">
            <a href="{{route('users.list')}}">
                <div class="btn btn-success m-1 col-12" style="height: 120px">
                    <i class="fa fa-users" style="font-size: 4em"></i>
                    <p class="text-center" style="font-size: 1.4em">
                        مدیریت کاربران
                    </p>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-3 m-auto">
            <a href="{{route('users.list')}}">
                <div class="btn btn-success m-1 col-12" style="height: 120px">
                    <i class="fa fa-bar-chart" style="font-size: 4em"></i>
                    <p class="text-center" style="font-size: 1.4em">
                        گزارشات
                    </p>
                </div>
            </a>
        </div>
    </div>
@endsection

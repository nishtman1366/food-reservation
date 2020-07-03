@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="row">
        <div class="col-12 col-md-3">
            <a href="{{route('reports.view',['name'=>'Food-orders'])}}" class="btn btn-outline-info col-12 m-1">لیست سفارشات غذا</a>
        </div>
        <div class="col-12 col-md-3">
            <a href="{{route('reports.view',['name'=>'user-orders'])}}" class="btn btn-outline-warning col-12 m-1">لیست غذای پرسنل</a>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col-12">
            @yield('reports_content')
        </div>
    </div>
@endsection

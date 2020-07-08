@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="row">
        <div class="col-12 col-md-3">
            <a href="{{route('reports.view',['name'=>'Food-Orders'])}}"
               class="btn btn-outline-info {{isset($active) && $active==1 ? 'active' : ''}} col-12 m-1">لیست سفارشات
                غذا</a>
        </div>
        <div class="col-12 col-md-3">
            <a href="{{route('reports.view',['name'=>'User-Orders'])}}" class="btn btn-outline-warning {{isset($active) && $active==2 ? 'active' : ''}} col-12 m-1">لیست
                غذای پرسنل</a>
        </div>
        <div class="col-12 col-md-3">
            <a href="{{route('reports.view',['name'=>'Polls'])}}" class="btn btn-outline-success {{isset($active) && $active==3 ? 'active' : ''}} col-12 m-1">لیست
                نظرسنجی</a>
        </div>
    </div>
    <div class="dropdown-divider"></div>
    <div class="row">
        <div class="col-12">
            @yield('reports_content')
        </div>
    </div>
@endsection

@extends('app')

@section('content')
    <div class="container-fluid d-flex flex-column"
         style="background-image: url('{{asset('assets/images/home-container-bg.png')}}')">
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

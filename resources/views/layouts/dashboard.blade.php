@extends('app')

@section('content')
    <div class="container-fluid d-flex flex-column"
         style="background-image: url('{{asset('assets/images/home-container-bg.png')}}')">
        <div class="row flex-grow-1">
            <div class="col-12 col-md-4 p-1">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">خوش آمدید</h3>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button class="btn btn-primary col-12">خروج از سیستم</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="card m-1">
                    <div class="card-body">
                        @yield('dashboard_content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

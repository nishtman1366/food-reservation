@extends('app')

@section('content')
    <div class="container-fluid d-flex flex-column" style="background-image: url('{{asset('assets/images/home-container-bg.png')}}')">
        <div class="row flex-grow-1">
            <div class="col-12 col-md-4 p-1">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">ورود به سیستم</h3>
                        <form action="{{route('sign.in')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="username">نام کاربری (کد پرسنلی)</label>
                                <input class="form-control" type="text" name="username" id="username">
                            </div>
                            <div class="form-group">
                                <label for="password">کلمه عبور (کد ملی)</label>
                                <input class="form-control" type="password" name="password" id="password">
                            </div>
                            <button class="btn btn-primary col-12">ورود</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">

            </div>
        </div>
    </div>
@endsection

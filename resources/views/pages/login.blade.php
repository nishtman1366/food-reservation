@extends('app')

@section('content')
    <div class="container-fluid d-flex flex-column h-100" style="background-image: url('{{asset('assets/images/home-bg.jpg')}}');background-size: cover">
        <div class="row flex-grow-1">
            <div class="col-12 col-md-4 p-1 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">سامانه ثبت سفارش غذا</h4>
                        <h3 class="text-center">شرکت ریخته گری دقیق پارس</h3>
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
                            <p class="text-center">
                                <button class="btn btn-primary col-2 m-auto">ورود</button>
                                <button class="btn btn-primary col-6 m-auto">دریافت کد پرسنلی</button>
                            </p>
                        </form>

                        <img src="{{asset('assets/images/logo.png')}}" class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

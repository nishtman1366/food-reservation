@extends('app')

@section('content')
    @include('components.popup')
    <div class="container-fluid h-100">
        <div class="h-50" id="separator"></div>
        <div class="row h-100">
            <div class="col-6 d-flex align-items-center justify-content-center">
                <div class="h-25 px-5">
                    <h2 class="text-right text-danger">سامانه برخط رزرواسیون</h2>
                    <h4 class="text-right">(غذا، اتاق جلسات، میهمان و ...)</h4>
                    <div class="d-flex justify-content-start">
                        <div class="px-3"><img style="width:50px" src="{{asset('assets/images/icons/chef.png')}}"></div>
                        <div class="px-3"><img style="width:50px" src="{{asset('assets/images/icons/conferance.png')}}">
                        </div>
                        <div class="px-3"><img style="width:50px" src="{{asset('assets/images/icons/guest.png')}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center">
                <div>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form id="login" action="{{route('sign.in')}}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M11,10V12H10V14H8V12H5.83C5.42,13.17 4.31,14 3,14A3,3 0 0,1 0,11A3,3 0 0,1 3,8C4.31,8 5.42,8.83 5.83,10H11M3,10A1,1 0 0,0 2,11A1,1 0 0,0 3,12A1,1 0 0,0 4,11A1,1 0 0,0 3,10M16,14C18.67,14 24,15.34 24,18V20H8V18C8,15.34 13.33,14 16,14M16,12A4,4 0 0,1 12,8A4,4 0 0,1 16,4A4,4 0 0,1 20,8A4,4 0 0,1 16,12Z"/>
                                    </svg>
                                </span>
                            </div>
                            <input type="text" class="form-control" name="username" id="username"
                                   placeholder="نام کاربری (کد پرسنلی)" aria-label="نام کاربری">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                              d="M22 17V16.5C22 15.12 20.88 14 19.5 14S17 15.12 17 16.5V17C16.45 17 16 17.45 16 18V22C16 22.55 16.45 23 17 23H22C22.55 23 23 22.55 23 22V18C23 17.45 22.55 17 22 17M21 17H18V16.5C18 15.67 18.67 15 19.5 15S21 15.67 21 16.5V17M8 8C8 5.79 9.79 4 12 4S16 5.79 16 8 14.21 12 12 12 8 10.21 8 8M14 20H4V18C4 15.79 7.58 14 12 14C13.27 14 14.46 14.15 15.53 14.41C15.32 14.82 15.15 15.25 15.07 15.71C14.42 16.26 14 17.08 14 18V20Z"/>
                                    </svg>
                                </span>
                            </div>
                            <input type="password" class="form-control h5" name="password" id="password"
                                   placeholder="کلمه عبور (کد ملی)" aria-label="کلمه عبور (کد ملی)">
                            <div class="d-flex align-items-center justify-content-center" style="cursor: pointer"
                                 id="submit">
                                <svg style="width:36px;height:36px" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="form-inline">
                            <label for="remember">مرا به خاطر بسپار</label>
                            <input class="form-check-inline" type="checkbox" name="remember" value="true"
                                   id="remember">

                            <a href="#" id="get-personal-code" class="btn btn-warning m-auto">دریافت کد
                                پرسنلی</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="d-flex align-items-end">
            <div class="flex-grow-1 w-75">
                <h6 class="text-center text-light">
                    تهیه شده در واحد فناوری اطلاعات و ارتباطات<br>
                    به سفارش واحد منابع انسانی
                </h6>
            </div>
            <div class="h-100 py-1 px-3">
                <img src="{{asset('assets/images/logo.png')}}" class="h-100" alt="شرکت ریخته گری دقیق پارس">
            </div>
        </footer>
    </div>

    <div class="modal fade" id="personal-code-Modal" tabindex="-1" role="dialog"
         aria-labelledby="personal-code-ModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="personal-code-ModalLabel">دریافت کد پرسنلی</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">نام خانوادگی خود را وارد نمایید</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-6 text-center">نام</div>
                        <div class="col-6 text-center">شماره پرسنلی</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row" id="users-list"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-primary" id="personal-code">دریافت لیست</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        #separator {
            width: 1px;
            position: absolute;
            top: 25%;
            left: 50%;
            background: linear-gradient(transparent, #fff 20%, #fff 80%, transparent);
        }

        footer {
            margin-left: -15px;
            margin-right: -15px;
            position: absolute;
            width: 100%;
            height: 5rem;
            bottom: 0;
            background: rgba(0, 0, 0, .3) linear-gradient(rgba(0, 0, 0, .1), transparent 0.4rem);
        }

        .input-group > .input-group-prepend > .input-group-text {
            border-top-right-radius: .25rem;
            border-bottom-right-radius: .25rem;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .input-group > .form-control:not(:first-child) {
            border-top-left-radius: .25rem;
            border-bottom-left-radius: .25rem;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            $("#username").focus();
            $("#submit").click(function () {
                $("#login").submit();
            });

            $(".form-control").keypress(function (e) {
                var key = e.which;
                if (key == 13) {
                    $("#login").submit();
                    return false;
                }
            });

            $('#personal-code').bind('click', function () {
                let name = $('#name').val();
                if (name.length === 0) {
                    toastr.error('لطفا قسمتی از نام خانوادگی خود را جهت جستجو وارد کنید.');
                } else {
                    $("#loading").addClass('d-flex');
                    Axios.post('users/personal-code', {name})
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                            let usersListContainer = $("#users-list");
                            usersListContainer.children().remove();
                            let users = response.data;
                            if (users.length > 0) {
                                for (let i = 0; i < users.length; i++) {
                                    usersListContainer.append('<div class="col-6 text-center">' + users[i].name + '</div>' +
                                        '<div class="col-6 text-center select-code" style="cursor: pointer"  data-toggle="tooltip" title="برای انتخاب دابل کلیک کنید">' + users[i].personal_code + '</div>');
                                }
                                $('[data-toggle="tooltip"]').tooltip();
                                $(".select-code").dblclick(function () {
                                    let code = $(this).text();
                                    $("#personal-code-Modal").modal('toggle');
                                    $("#username").val(code);
                                });
                            } else {
                                usersListContainer.append('<div class="col-12">' +
                                    '<h4 class="text-info text-center">موردی یافت نشد</h4>' +
                                    '</div>');
                            }
                        })
                        .catch(function (error) {
                            toastr.error('به علت اشکال داخلی انجام نشد.');
                            console.log(error);
                        })
                        .finally(function () {
                            $("#loading").removeClass('d-flex');
                        });
                }
            });
            $("#get-personal-code").click(function () {
                $("#personal-code-Modal").modal('toggle');
            });
        });
    </script>
@endpush

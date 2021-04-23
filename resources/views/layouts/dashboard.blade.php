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
                            </div>
                        </li>
                        <li class="nav-item font-size-normal dropdown">
                            <a class="nav-link dropdown-toggle app-bar-menu-item"
                               id="foods-reservation"
                               href="{{route('foods.reservation')}}"
                               role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                رزرواسیون
                            </a>
                            <div class="app-bar-menu dropdown-menu dropdown-menu-right"
                                 aria-labelledby="#foods-reservation">
                                <div>
                                    <a class="dropdown-item text-right font-size-small"
                                       href="{{route('reservations.list')}}">
                                        لیست درخواست ها
                                    </a>
                                </div>
                                <div>
                                    <a class="dropdown-item text-right font-size-small"
                                       href="{{route('reservations.create')}}">
                                        ثبت درخواست
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item font-size-normal dropdown">
                            <a class="nav-link dropdown-toggle app-bar-menu-item"
                               id="users-management"
                               href="#"
                               role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                کاربران
                            </a>
                            <div class="app-bar-menu dropdown-menu dropdown-menu-right"
                                 aria-labelledby="#users-management">
                                <div>
                                    <a class="dropdown-item text-right font-size-small"
                                       href="{{route('users.list')}}">
                                        مدیریت کابران
                                    </a>
                                </div>
                                <div>
                                    <a class="dropdown-item text-right font-size-small"
                                       href="{{route('users.units.list')}}">
                                        مدیریت واحدهای شغلی
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item font-size-normal dropdown">
                            <a class="nav-link app-bar-menu-item" href="{{route('popups.list')}}" role="button">
                               اطلاعیه ها
                            </a>
                        </li>
                        <li class="nav-item font-size-normal dropdown">
                            <a class="nav-link app-bar-menu-item" href="{{route('reports.list')}}" role="button">
                                گزارشات
                            </a>
                        </li>
                        <li class="nav-item font-size-normal dropdown">
                            <a class="nav-link app-bar-menu-item" href="{{route('settings.main')}}" role="button">
                                تنظیمات
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
                        <div class="row">
                            <div class="col-6 m-auto text-center">
                                <img src="{{asset('assets/images/avatar.png')}}" class="w-75">
                            </div>
                        </div>
                        <h5 class="text-center">{{Auth::user()->name}} خوش آمدید</h5>
                        <div class="row text-right">
                            <div class="col-12 m-1">شماره پرسنلی: {{Auth::user()->personal_code}}</div>
                            <div class="col-12 m-1">شماره ملی: {{Auth::user()->national_code}}</div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <div class="col-6"><button class="btn btn-outline-info" id="change-password-btn">تغییر کلمه عبور</button></div>
                            <div class="col-6">
                                <form action="{{route('logout')}}" method="post">
                                    @csrf
                                    <button class="btn btn-outline-danger col-12">خروج از سیستم</button>
                                </form>
                            </div>
                        </div>
                        <img src="{{asset('assets/images/logo.png')}}" class="w-100" alt="شرکت ریخته گری دقیق پارس">
                        <h6 class="text-center text-light border border-dark rounded bg-danger">
                            تهیه شده در واحد فناوری اطلاعات و ارتباطات<br>
                            به سفارش واحد منابع انسانی
                        </h6>
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
    <div class="modal fade" id="change-password-Modal" tabindex="-1" role="dialog"
         aria-labelledby="change-password-ModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="change-password-ModalLabel">تغییر کلمه عبور</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-right" id="message-container"></div>
                    <div class="form-group">
                        <label for="old-password">کلمه عبور کنونی</label>
                        <input type="password" name="oldPassword" id="old-password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new-password">کلمه عبور جدید</label>
                        <input type="password" name="newPassword" id="new-password" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-primary" id="change-password">ذخیره اطلاعات</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('#change-password').click(function () {
                let oldPassword = $('#old-password').val();
                let newPassword = $('#new-password').val();
                $("#loading").addClass('d-flex');
                Axios.post('users/change-password', {oldPassword, newPassword})
                    .then(function (response) {
                        $("#loading").removeClass('d-flex');
                        $("#message-container").removeClass('alert alert-danger').addClass('alert alert-success').html('کلمه عبور با موفقیت تغییر یافت');
                        toastr.success('با موفقیت انجام شد.');
                    })
                    .catch(function (error) {
                        $("#loading").removeClass('d-flex');
                        $("#message-container").addClass('alert alert-danger').html(error.response.data.message);
                        toastr.error('به علت اشکال داخلی انجام نشد.');
                    })
                    .finally(function () {

                    });
            });
            $("#change-password-btn").click(function () {
                $("#change-password-Modal").modal('toggle');
            });
        });
    </script>
@endpush

@extends('app')

@section('content')
    <div class="container-fluid d-flex flex-column h-100"
         style="background-image: url('{{asset('assets/images/home-bg.jpg')}}');background-size: cover">
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
                                <a href="#" id="get-personal-code" class="btn btn-primary col-6 m-auto">دریافت کد
                                    پرسنلی</a>
                            </p>
                        </form>
                        <img src="{{asset('assets/images/logo.png')}}" class="w-100" alt="شرکت ریخته گری دقیق پارس">
                        <h6 class="text-center text-light border border-dark rounded bg-danger">
                            تهیه شده در واحد فناوری اطلاعات و ارتباطات<br>
                            به سفارش واحد منابع انسانی
                        </h6>
                    </div>
                </div>
            </div>
        </div>
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
@push('js')
    <script>
        $(document).ready(function () {
            $('#personal-code').bind('click', function () {
                let name = $('#name').val();
                if(name.length===0){
                    toastr.error('لطفا قسمتی از نام خانوادگی خود را جهت جستجو وارد کنید.');
                }else{
                    Axios.post('users/personal-code', {name})
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                            let usersListContainer = $("#users-list");
                            usersListContainer.children().remove();
                            let users = response.data;
                            if (users.length > 0) {
                                for (let i = 0; i < users.length; i++) {
                                    usersListContainer.append('<div class="col-6 text-center">' + users[i].name + '</div>' +
                                        '<div class="col-6 text-center">' + users[i].personal_code + '</div>');
                                }
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

                        });
                }
            });
            $("#get-personal-code").click(function () {
                $("#personal-code-Modal").modal('toggle');
            });
        });
    </script>
@endpush

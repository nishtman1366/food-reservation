@extends('app')

@section('content')
    @include('components.popup')
    <div class="container-fluid h-100">
        <div class="h-50" id="separator"></div>
        <div class="row h-100">
            <div class="col-6 d-flex align-items-center justify-content-center">

                <img class="w-100" src="{{asset('assets/images/login-bg.png')}}">

            </div>
            <div class="col-6 d-flex align-items-center justify-content-center"
                 style="-webkit-animation: fadeIn 1s;animation: fadeIn 1s">
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
                        <div style="position: relative;padding-left: 5.5rem">
                            <div class="form-fields">
                                <div class="username">
                                    <label>نام کاربری (کد پرسنلی)</label>
                                    <input type="text"
                                           name="username" id="username">
                                </div>
                                <div class="password">
                                    <label>کلمه عبور (کد ملی)</label>
                                    <input type="password"
                                           name="password" id="password">
                                </div>
                            </div>
                            <div id="submit">
                                <a onclick="">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                                        <filter id="submit_drop_shadow">
                                            <feGaussianBlur in="SourceAlpha" stdDeviation="4"></feGaussianBlur>
                                            <feOffset dx="0" dy="8"></feOffset>
                                            <feComponentTransfer>
                                                <feFuncA type="linear" slope="0.1"></feFuncA>
                                            </feComponentTransfer>
                                            <feMerge>
                                                <feMergeNode></feMergeNode>
                                                <feMergeNode in="SourceGraphic"></feMergeNode>
                                            </feMerge>
                                        </filter>
                                        <path d="M29.1,44.2l3.9-3.9L17.7,25L33,9.7l-3.9-3.9L9.9,25L29.1,44.2z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="d-flex align-items-center px-3">
            <img src="{{asset('assets/images/brand-logo.png')}}" class="h-50" alt="شرکت ریخته گری دقیق پارس">
            <div class="text-right pr-2 text-light">تهیه شده در واحد فناوری اطلاعات و ارتباطات ( فاوا ) شرکت ریخته گری
                دقیق پارس
            </div>
            <div class="flex-grow-1">
                <a href="#" id="get-personal-code" class="btn btn-warning m-auto">دریافت کد
                    پرسنلی</a>
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

        .form-fields > div {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            padding-right: 60.8px;
            padding-right: 3.8rem;
            border-radius: .3rem;
            margin: 24px 0;
            margin: 1.5rem 0;
            position: relative;
            overflow: hidden;
            -webkit-box-shadow: 0 0 0.2rem rgba(255, 255, 255, 0), 0 0.7rem 1rem rgba(0, 0, 0, .05);
            box-shadow: 0 0 0.2rem rgba(255, 255, 255, 0), 0 0.7rem 1rem rgba(0, 0, 0, .05);
            -webkit-transition: -webkit-box-shadow .5s;
            transition: -webkit-box-shadow .5s;
            transition: box-shadow .5s;
            transition: box-shadow .5s, -webkit-box-shadow .5s;
            -webkit-animation: form-field .7s both;
            animation: form-field .7s both;
            animation-delay: 0s;
            -webkit-animation-delay: .15s;
            animation-delay: .15s;
        }

        .form-fields > div:before {
            content: '';
            position: absolute;
            right: 0;
            bottom: 0;
            top: 0;
            width: 60.8px;
            width: 3.8rem;
            background: rgba(0, 0, 0, .3) 50% 50% no-repeat;
            background-image: none;
            background-size: auto;
            background-size: 1.6rem;
            opacity: 0.7;
            border-radius: 0 .3rem .3rem 0;
            -webkit-transition: all 0.2s;
            transition: all 0.2s;
        }

        .form-fields > div label {
            position: absolute;
            top: 20.8px;
            top: 1.3rem;
            right: 76.8px;
            right: 4.8rem;
            font-size: 16px;
            font-size: 1rem;
            opacity: 0.4;
            pointer-events: none;
            -webkit-transition: all .2s;
            transition: all .2s;
        }

        .form-fields > div.filled label {
            top: 12.8px;
            top: .8rem;
            font-size: 11.2px;
            font-size: .7rem;
            opacity: 0.5;
        }

        .form-fields > div input {
            display: block;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            width: 320px;
            width: 20rem;
            background: rgba(255, 255, 255, .8);
            border: none;
            padding: 27.2px 16px 11.2px 16px;
            padding: 1.7rem 1rem .7rem 1rem;
            outline: none;
            font-size: 20.8px;
            font-size: 1.3rem;
            -webkit-transition: background-color 0.5s;
            transition: background-color 0.5s;
        }

        .form-fields > div.username:before {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='27.85' height='27.85' viewBox='0 0 27.85 27.85'%3E %3Cg id='person'%3E %3Cg id='Group_22' data-name='Group 22'%3E %3Cpath id='Path_886' data-name='Path 886' d='M18.8,17.174a9.161,9.161,0,0,0,4.41-7.891,9.283,9.283,0,1,0-18.567,0,9.161,9.161,0,0,0,4.41,7.891A14.351,14.351,0,0,0,0,27.85H2.321a11.894,11.894,0,0,1,23.208,0H27.85A13.976,13.976,0,0,0,18.8,17.174ZM6.962,9.283a6.962,6.962,0,1,1,6.962,6.962A6.983,6.983,0,0,1,6.962,9.283Z' fill='%23fff'/%3E %3C/g%3E %3C/g%3E %3C/svg%3E");
        }

        .form-fields > div.password:before {
            background-image: url("data:image/svg+xml;charset=utf-8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='28.322' height='29.593' viewBox='0 0 28.322 29.593'%3E %3Cg id='Group_58' data-name='Group 58' transform='translate(-11 0)' fill='%23fff'%3E %3Cpath id='Path_939' data-name='Path 939' d='M25.369,194.947H13.358v-8.2H25.369ZM15.225,184.393a4.146,4.146,0,0,1,8.288,0Zm-2.364,0c0,.1-1.7-.433-1.861,1.179v10.554a1.177,1.177,0,0,0,1.179,1.179H26.548a1.177,1.177,0,0,0,1.179-1.179V185.572c-.15-1.584-1.861-1.1-1.861-1.179,0,0-.5-6.393-6.5-6.393S12.861,184.393,12.861,184.393Z' transform='translate(0 -167.712)'/%3E %3Cg id='Group_57' data-name='Group 57' transform='translate(11)'%3E %3Cpath id='Path_940' data-name='Path 940' d='M34.767,14.415a4.563,4.563,0,0,0,4.555-4.555V4.555A4.563,4.563,0,0,0,34.767,0H15.555A4.563,4.563,0,0,0,11,4.555V9.861a4.219,4.219,0,0,0,1.929,3.72l.117.06a5.532,5.532,0,0,1,1.287-1.946l-.148-.118a2.217,2.217,0,0,1-.827-1.717V4.555a2.2,2.2,0,0,1,2.2-2.2H34.767a2.2,2.2,0,0,1,2.2,2.2V9.861a2.2,2.2,0,0,1-2.2,2.2h-9.9l-.1,0a7.488,7.488,0,0,1,1.149,2.357Z' transform='translate(-11)'/%3E %3Ccircle id='Ellipse_83' data-name='Ellipse 83' cx='1.635' cy='1.635' r='1.635' transform='translate(5.359 5.573)'/%3E %3Ccircle id='Ellipse_84' data-name='Ellipse 84' cx='1.635' cy='1.635' r='1.635' transform='translate(19.231 5.573)'/%3E %3Ccircle id='Ellipse_85' data-name='Ellipse 85' cx='1.635' cy='1.635' r='1.635' transform='translate(12.295 5.573)'/%3E %3C/g%3E %3C/g%3E %3C/svg%3E");
        }

        #submit {
            position: absolute;
            left: 0;
            bottom: -1.6px;
            bottom: -0.1rem;
        }

        #submit a {
            display: block;
            cursor: pointer;
            width: 64px;
            width: 4rem;
            height: 64px;
            height: 4rem;
            text-align: center;
            position: relative;
            -webkit-transition: opacity 0.2s, -webkit-transform 0.2s;
            transition: opacity 0.2s, -webkit-transform 0.2s;
            transition: opacity 0.2s, transform 0.2s;
            transition: opacity 0.2s, transform 0.2s, -webkit-transform 0.2s;
            opacity: 0.7;
        }

        #submit a:before {
            background: -webkit-gradient(linear, left top, right bottom, from(rgba(15, 200, 255, .5)), to(rgba(0, 250, 20, .5)));
            background: linear-gradient(to right bottom, rgba(15, 200, 255, .5), rgba(0, 250, 20, .5));
            -webkit-box-shadow: 0 0.4rem 1rem rgba(0, 0, 0, .1);
            box-shadow: 0 0.4rem 1rem rgba(0, 0, 0, .1);
        }

        #submit a:before, #submit a:after {
            display: block;
            cursor: pointer;
            width: 64px;
            width: 4rem;
            height: 64px;
            height: 4rem;
            text-align: center;
            position: relative;
            -webkit-transition: opacity 0.2s, -webkit-transform 0.2s;
            transition: opacity 0.2s, -webkit-transform 0.2s;
            transition: opacity 0.2s, transform 0.2s;
            transition: opacity 0.2s, transform 0.2s, -webkit-transform 0.2s;
            opacity: 0.7;

            content: '';
            border-radius: 100%;
            border: 1px solid rgba(255, 255, 255, .3);
            -webkit-transform: scale(1.2);
            transform: scale(1.2);
            opacity: 0;
            -webkit-transition: all 0.2s cubic-bezier(0.215, 0.61, 0.355, 1);
            transition: all 0.2s cubic-bezier(0.215, 0.61, 0.355, 1);
            z-index: -1;

            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }

        #submit a svg {
            margin: 8px;
            margin: .5rem;
            width: 48px;
            width: 3rem;
            height: 48px;
            height: 3rem;
            -webkit-animation: submit-button 0.5s cubic-bezier(0.215, 0.61, 0.355, 1) both;
            animation: submit-button 0.5s cubic-bezier(0.215, 0.61, 0.355, 1) both;
            animation-delay: 0s;
            -webkit-animation-delay: .55s;
            animation-delay: .55s;
        }

        #submit a:after {
            border: 1px solid rgba(255, 255, 255, .1);
            -webkit-transform: scale(1.7);
            transform: scale(1.7);
            -webkit-transition-duration: 0.4s;
            transition-duration: 0.4s;
        }

        @keyframes submit-button {
            0% {
                -webkit-transform: translateX(1rem);
                transform: translateX(1rem);
                opacity: 0;
            }
        }

        @keyframes form-field {
            0% {
                -webkit-transform: translateX(1rem);
                transform: translateX(1rem);
                opacity: 0;
            }
            100% {
                -webkit-transform: translateX(0);
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            $("#username").focus();
            $(".form-fields > div input").focus(function () {
                $(this).parent().addClass('filled');
            });
            $(".form-fields > div input").blur(function () {
                if ($(this).val() === '') {
                    $(this).parent().removeClass('filled');
                }
            });
            $("#submit").click(function () {
                $("#login").submit();
            });

            $(".form-fields > div input").keypress(function (e) {
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

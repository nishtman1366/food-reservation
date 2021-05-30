@extends('layouts.dashboard')

@section('dashboard_content')
    @if(count($questions) > 0)
        <div class="card">
            <div class="card-header text-center">
                نظرسنجی
            </div>
            <div class="card-body">
                <form action="{{route('surveys.submit')}}" method="post">
                    @csrf
                    <div class="row m-2 p-2">
                        @if(old('surveys'))
                            <div class="col-12 alert alert-success text-right">
                                {{old('surveys')}}
                            </div>
                        @endif
                        <div class="col-12 text-right" style="direction: rtl">
                            @php
                            $i=0;
                            @endphp
                            @foreach($questions as $question)
                                @if(!$question->voted)
                                    @php($i++)
                                    <div class="row">{{$question->voted}}
                                        <div class="col-12 my-3">
                                            <p class="text-lg">{{$question->title}}</p>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                @foreach($question->answers as $answer)
                                                    <label
                                                        class="btn btn-outline-info {{!$loop->last ? 'border-left-0' : ''}}"
                                                        style="border-radius: {{(($loop->first) ? '0 3px 3px 0' : (($loop->last) ? '3px 0 0 3px' : '0'))}}"
                                                        id="answer_{{$answer->id}}">
                                                        <input type="radio"
                                                               name="questions[{{$question->id}}]"
                                                               value="{{$answer->id}}"
                                                               id="answer_{{$answer->id}}"
                                                               autocomplete="off">{{$answer->answer}}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if($i > 0)
                            <div class="text-center">
                                <button class="btn btn-success">ذخیره اطلاعات</button>
                            </div>
                            @else
                                <div class="text-center">
                                    شما پیش از این به تمامی سوالات نظرسنجی پاسخ داده اید.
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <div class="row m-1 p-1">
        <div class="col-12 col-md-3 m-auto">
            <a href="{{route('orders')}}">
                <div class="btn btn-success m-1 col-12" style="height: 120px">
                    <i class="fa fa-cutlery" style="font-size: 4em"></i>
                    <p class="text-center" style="font-size: 1.4em">
                        رزرو غذا
                    </p>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-3 m-auto">
            <a href="{{route('reservations.create')}}">
                <div class="btn btn-success m-1 col-12" style="height: 120px">
                    <i class="fa fa-history" style="font-size: 4em"></i>
                    <p class="text-center" style="font-size: 1em">
                        رزرو اتاق جلسات<br>
                        ورود مهمان
                    </p>
                </div>
            </a>
        </div>
        @if(Auth::user()->level==1)
            <div class="col-12"></div>
            <div class="col-12 col-md-3 m-auto">
                <a href="{{route('users.list')}}">
                    <div class="btn btn-success m-1 col-12" style="height: 120px">
                        <i class="fa fa-users" style="font-size: 4em"></i>
                        <p class="text-center" style="font-size: 1.4em">
                            مدیریت کاربران
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-3 m-auto">
                <a href="{{route('popups.list')}}">
                    <div class="btn btn-success m-1 col-12" style="height: 120px">
                        <i class="fa fa-bell" style="font-size: 4em"></i>
                        <p class="text-center" style="font-size: 1.4em">
                            اطلاعیه ها
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-12 col-md-3 m-auto">
                <a href="{{route('reports.list')}}">
                    <div class="btn btn-success m-1 col-12" style="height: 120px">
                        <i class="fa fa-bar-chart" style="font-size: 4em"></i>
                        <p class="text-center" style="font-size: 1.4em">
                            گزارشات
                        </p>
                    </div>
                </a>
            </div>
        @endif
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.vote').click(function () {
                let vote = $(this).attr('data-value');
                $("#loading").addClass('d-flex');
                Axios.post('polls', {vote})
                    .then(function (response) {
                        toastr.success('با موفقیت انجام شد.');
                    })
                    .catch(function (error) {
                        toastr.error(error.response.data);
                    })
                    .finally(function () {
                        $("#loading").removeClass('d-flex');
                    });
            });
        });
    </script>
@endpush

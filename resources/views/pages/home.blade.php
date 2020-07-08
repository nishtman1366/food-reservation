@extends('layouts.dashboard')

@section('dashboard_content')
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
        @if(Auth::user()->level==1)
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
    @if(!$poll)
        <div class="row m-1 p-1">
            <div class="col-12">
                <h4 class="text-right">نظرسنجی</h4>
                <h5 class="text-right">نظرتون راجع به غذای دیروز چیه؟</h5>
                <div class="row">
                    <div class="col-2 m-auto"><img data-toggle="tooltip" title="افتضاح بود" data-value="1"
                                                   src="{{asset('assets/images/poll/1.png')}}" class="w-100 vote"></div>
                    <div class="col-2 m-auto"><img data-toggle="tooltip" title="بدمزه بود" data-value="2"
                                                   src="{{asset('assets/images/poll/2.png')}}" class="w-100 vote"></div>
                    <div class="col-2 m-auto"><img data-toggle="tooltip" title="معمولی" data-value="3"
                                                   src="{{asset('assets/images/poll/3.png')}}" class="w-100 vote"></div>
                    <div class="col-2 m-auto"><img data-toggle="tooltip" title="خوشمزه بود" data-value="4"
                                                   src="{{asset('assets/images/poll/4.png')}}" class="w-100 vote"></div>
                    <div class="col-2 m-auto"><img data-toggle="tooltip" title="عالی بود" data-value="5"
                                                   src="{{asset('assets/images/poll/5.png')}}" class="w-100 vote"></div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.vote').click(function () {
                let vote = $(this).attr('data-value');
                Axios.post('polls', {vote})
                    .then(function (response) {
                        toastr.success('با موفقیت انجام شد.');
                    })
                    .catch(function (error) {
                        toastr.error(error.response.data);
                    })
                    .finally(function () {

                    });
            });
        });
    </script>
@endpush

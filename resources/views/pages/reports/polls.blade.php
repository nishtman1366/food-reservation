@extends('pages.reports.list',['active'=>3])

@section('reports_content')
    <form action="{{route('reports.view',['name'=>'Polls'])}}" method="post">
        @csrf
        <input type="hidden" name="gDate" id="gDate" value="{{isset($gDate) && !is_null($gDate) ? $gDate : ''}}">
        <div class="row">
            <div class="col-12 col-md-8 m-auto">
                <div class="input-group">
                    <span class="input-group-text border-left-0"
                          style="border-top-left-radius: 0;border-bottom-left-radius: 0;">تاریخ:</span>
                    <input id="jDate" type="text" data-mddatetimepicker="true" data-placement="right" name="jDate"
                           class="form-control border-right-0 border-left-0" readonly
                           style="border-radius: 0;" placeholder="تاریخ بصورت: 1399/01/12"
                           value="{{isset($jDate) && !is_null($jDate) ? $jDate : ''}}">
                    <button class="btn btn-primary border-right-0"
                            style="border-top-right-radius: 0;border-bottom-right-radius: 0;">جستجو
                    </button>
                </div>
            </div>
            {{--            <div class="col-4 pull-left">--}}
            {{--                @if(!is_null($downloadLink))--}}
            {{--                    <a href="{{$downloadLink}}" class="btn btn-outline-success" data-toggle="tooltip"--}}
            {{--                       title="دریافت فایل اکسل">--}}
            {{--                        <i class="fa fa-file-excel-o"></i>--}}
            {{--                    </a>--}}
            {{--                @endif--}}
            {{--            </div>--}}
        </div>
    </form>
    <div class="dropdown-divider"></div>
    @if(isset($gDate))
        <div class="row">
            <div class="col-12 col-md-3 text-center alert alert-primary">مجموع آرا</div>
            <div class="col-12 col-md-3 text-center alert alert-danger persian-numbers">{{$count}} رای</div>
            <div class="col-12 col-md-3 text-center alert alert-primary">میانگین امتیاز</div>
            <div class="col-12 col-md-3 text-center alert alert-danger persian-numbers">{{$score}} امتیاز</div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 m-auto">
                <div class="row">
                    <div class="col-6"><img src="{{asset('assets/images/poll/5.png')}}" class="w-100"></div>
                    <div class="col-6 text-center d-flex align-items-center persian-numbers"><h4>{{$votes[4]}} رای</h4></div>
                    <div class="dropdown-divider"></div>
                    <div class="col-6"><img src="{{asset('assets/images/poll/4.png')}}" class="w-100"></div>
                    <div class="col-6 text-center d-flex align-items-center persian-numbers"><h4>{{$votes[3]}} رای</h4></div>
                    <div class="dropdown-divider"></div>
                    <div class="col-6"><img src="{{asset('assets/images/poll/3.png')}}" class="w-100"></div>
                    <div class="col-6 text-center d-flex align-items-center persian-numbers"><h4>{{$votes[2]}} رای</h4></div>
                    <div class="dropdown-divider"></div>
                    <div class="col-6"><img src="{{asset('assets/images/poll/2.png')}}" class="w-100"></div>
                    <div class="col-6 text-center d-flex align-items-center persian-numbers"><h4>{{$votes[1]}} رای</h4></div>
                    <div class="dropdown-divider"></div>
                    <div class="col-6"><img src="{{asset('assets/images/poll/1.png')}}" class="w-100"></div>
                    <div class="col-6 text-center d-flex align-items-center persian-numbers"><h4>{{$votes[0]}} رای</h4></div>
                </div>
            </div>
        </div>
    @else
        <h3 class="text-center text-info">لطفا تاریخ گزارش را انتخاب کنید</h3>
    @endif
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('#jDate').MdPersianDateTimePicker({
                // dateFormat: 'Y/m/d',
                // disableBeforeToday: true,
                targetTextSelector: '#jDate',
                targetDateSelector: '#gDate'
            });
        });
    </script>
@endpush

@extends('pages.reports.list',['active'=>4])

@section('reports_content')
    <form action="{{route('reports.view',['name'=>'Units-Orders'])}}" method="post">
        @csrf
        <input type="hidden" name="gDateFrom" id="gDateFrom" value="{{isset($gDateFrom) && !is_null($gDateFrom) ? $gDateFrom : ''}}">
        <input type="hidden" name="gDateTo" id="gDateTo" value="{{isset($gDateTo) && !is_null($gDateTo) ? $gDateTo : ''}}">

        <div class="row">
            <div class="col-12 col-md-6 m-auto">
                <div class="input-group">
                    <span class="input-group-text border-left-0"
                          style="border-top-left-radius: 0;border-bottom-left-radius: 0;">از تاریخ:</span>
                    <input id="jDateFrom" type="text" data-mddatetimepicker="true" data-placement="right" name="jDateFrom"
                           class="form-control border-right-0 border-left-0" readonly
                           style="border-radius: 0;" placeholder="تاریخ بصورت: 1399/01/12"
                           value="{{isset($jDateFrom) && !is_null($jDateFrom) ? $jDateFrom : ''}}">
                    <span class="input-group-text border-left-0"
                          style="border-top-left-radius: 0;border-bottom-left-radius: 0;">تا تاریخ:</span>
                    <input id="jDateTo" type="text" data-mddatetimepicker="true" data-placement="right" name="jDateTo"
                           class="form-control border-right-0 border-left-0" readonly
                           style="border-radius: 0;" placeholder="تاریخ بصورت: 1399/01/12"
                           value="{{isset($jDateTo) && !is_null($jDateTo) ? $jDateTo : ''}}">
                    <button class="btn btn-primary border-right-0"
                            style="border-top-right-radius: 0;border-bottom-right-radius: 0;">جستجو
                    </button>
                </div>
            </div>
            <div class="col-6 pull-left">
                @if(!is_null($downloadLink))
                    <a href="{{$downloadLink}}" class="btn btn-outline-success" data-toggle="tooltip"
                       title="دریافت فایل اکسل">
                        <i class="fa fa-file-excel-o"></i>
                    </a>
                @endif
            </div>
        </div>
    </form>
    <div class="dropdown-divider"></div>
    @if(isset($jDateFrom) && isset($jDateTo))
        @if(count($list) > 0)
            <table class="table table-hover">
                <tr>
                    <th colspan="3">
                        گزارش مربوط به تاریخ {{$jDateFrom}} تا تاریخ {{$jDateTo}}
                    </th>
                </tr>
                <tr>
                    <th scope="col">ردیف</th>
                    <th scope="col">نام واحد</th>
                    <th scope="col">تعداد سفارش</th>
                </tr>
                @foreach($list as $item)
                    <tr>
                        <td class="persian-numbers">{{$item['#']}}</td>
                        <td>{{$item['unit']}}</td>
                        <td class="persian-numbers">{{$item['ordersCount']}}</td>
                    </tr>
                @endforeach
            </table>
        @else
            <h3 class="text-center text-info">موردی برای نمایش وجود ندارد</h3>
        @endif
    @else
        <h3 class="text-center text-info">لطفا تاریخ گزارش را انتخاب کنید</h3>
    @endif
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('#jDateFrom').MdPersianDateTimePicker({
                targetTextSelector: '#jDateFrom',
                targetDateSelector: '#gDateFrom'
            });
            $('#jDateTo').MdPersianDateTimePicker({
                targetTextSelector: '#jDateTo',
                targetDateSelector: '#gDateTo'
            });
        });
    </script>
@endpush

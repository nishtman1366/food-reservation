@extends('pages.reports.list',['active'=>2])

@section('reports_content')
    <form action="{{route('reports.view',['name'=>'User-Orders'])}}" method="post">
        @csrf
        <input type="hidden" name="gDate" id="gDate" value="{{isset($gDate) && !is_null($gDate) ? $gDate : ''}}">
        <div class="row">
            <div class="col-12 col-md-6 m-auto">
                <div class="input-group">
                    <span class="input-group-text border-left-0"
                          style="border-top-left-radius: 0;border-bottom-left-radius: 0;">تاریخ:</span>
                    <input id="jDate" type="text" data-mddatetimepicker="true" data-placement="right" name="jDate"
                           class="form-control border-right-0 border-left-0" readonly
                           style="border-radius: 0;" placeholder="تاریخ بصورت: 1399/01/12"
                           value="{{isset($jDate) && !is_null($jDate) ? $jDate : ''}}">
                    <span class="input-group-text border-left-0 border-right-0" style="border-radius: 0;" >ناهار</span>
                    <input style="background-color: #e9ecef" checked type="radio" name="type" value="1">
                    <span class="input-group-text border-left-0 border-right-0" style="border-radius: 0;" >شام</span>
                    <input type="radio" name="type" value="2" autocomplete="off">
                    <button class="btn btn-primary border-right-0" style="border-top-right-radius: 0;border-bottom-right-radius: 0;">جستجو</button>
                </div>
            </div>
            <div class="col-6 pull-left">
                @if(!is_null($downloadLink))
                    <a href="{{$downloadLink}}" class="btn btn-outline-success" data-toggle="tooltip" title="دریافت فایل اکسل">
                        <i class="fa fa-file-excel-o"></i>
                    </a>
                @endif
            </div>
        </div>
    </form>
    <div class="dropdown-divider"></div>
    @if(isset($gDate))
        @if(count($list) > 0)
            <table class="table table-hover">
                <tr>
                    <th colspan="3">
                        گزارش مربوط به تاریخ {{$jDate}}
                    </th>
                </tr>
                <tr>
                    <th scope="col">ردیف</th>
                    <th scope="col">نام</th>
                    <th scope="col">نام غذا</th>
                </tr>
                @foreach($list as $item)
                    <tr>
                        <td class="persian-numbers">{{$item['#']}}</td>
                        <td>{{$item['name']}}</td>
                        <td class="persian-numbers">{{$item['food']}}</td>
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
            $('#jDate').MdPersianDateTimePicker({
                disableBeforeToday: true,
                targetTextSelector: '#jDate',
                targetDateSelector: '#gDate'
            });
        });
    </script>
@endpush

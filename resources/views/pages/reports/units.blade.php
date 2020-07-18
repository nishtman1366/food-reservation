@extends('pages.reports.list',['active'=>4])

@section('reports_content')
    <form action="{{route('reports.view',['name'=>'Units-Orders'])}}" method="post">
        @csrf
        <div class="row">
            <div class="col-12 col-md-6 m-auto">
                <div class="input-group">
                    <span class="input-group-text border-left-0"
                          style="border-top-left-radius: 0;border-bottom-left-radius: 0;">تاریخ:</span>
                    <select name="month" size="1" class="form-control border-right-0 border-left-0"
                            style="border-radius: 0;">
                        <option value="">انتخاب:</option>
                        @foreach($monthes as $key=>$value)
                            <option
                                value="{{$key+1}}" {{($key+1)==$selectedMonth ? 'selected' : ''}}>{{$value}}</option>
                        @endforeach
                    </select>
{{--                    <span class="input-group-text border-left-0 border-right-0" style="border-radius: 0;">ناهار</span>--}}
{{--                    <input type="radio" name="type" value="1" autocomplete="off">--}}
{{--                    <span class="input-group-text border-left-0 border-right-0" style="border-radius: 0;">شام</span>--}}
{{--                    <input type="radio" name="type" value="2" autocomplete="off">--}}
                    <button class="btn btn-primary border-right-0"
                            style="border-top-right-radius: 0;border-bottom-right-radius: 0;">جستجو
                    </button>
                </div>
            </div>
            {{--            <div class="col-6 pull-left">--}}
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
    @if(isset($selectedMonth) && $selectedMonth!=0)
        @if(count($list) > 0)
            <table class="table table-hover">
                <tr>
                    <th colspan="3">
                        گزارش مربوط به ماه {{$monthes[$selectedMonth-1]}}
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

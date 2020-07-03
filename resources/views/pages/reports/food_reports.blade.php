@extends('pages.reports.list',['active'=>1])

@section('reports_content')
    <form action="{{route('reports.view',['name'=>'Food-orders'])}}" method="post">
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
                    <button class="btn btn-primary border-right-0" style="border-top-right-radius: 0;border-bottom-right-radius: 0;">جستجو</button>
                </div>
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
                    <th scope="col">نام غذا</th>
                    <th scope="col">تعداد</th>
                </tr>
                @foreach($list as $item)
                    <tr>
                        <td></td>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['count']}}</td>
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
                // dateFormat: 'Y/m/d',
                disableBeforeToday: true,
                targetTextSelector: '#jDate',
                targetDateSelector: '#gDate'
            });
        });
    </script>
@endpush

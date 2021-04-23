@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="row">
        <div class="col-12">
            @if(!is_null(old('message')))
                <h4 class="text-center text-success">درخواست شما با موفقیت ثبت شد.</h4>
                <h5 class="text-center text-success">نتیجه درخواست به اطلاع شما خواهد رسید.</h5>
            @else
                <form action="{{route('reservations.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-12 col-md-6 col-lg-4">
                            <label for="first_name">نام:</label>
                            <input class="form-control"
                                   disabled
                                   value="{{Auth::user()->first_name}}" type="text" id="first_name"
                                   name="first_name">
                        </div>
                        <div class="form-group col-12 col-md-6 col-lg-4">
                            <label for="last_name">نام خانوادگی:</label>
                            <input class="form-control"
                                   disabled
                                   value="{{Auth::user()->last_name}}" type="text" id="last_name"
                                   name="last_name">
                        </div>
                        <div class="form-group col-12 col-md-6 col-lg-4">
                            <label for="semat">سمت:</label>
                            <input class="form-control"
                                   disabled
                                   value="{{!is_null(Auth::user()->unit) ? Auth::user()->unit->name : ''}}" type="text"
                                   id="semat" name="semat">
                        </div>
                        <div class="form-group col-12 col-md-8">
                            <label for="subject">موضوع:</label>
                            <input class="form-control @error('subject') is-invalid @enderror" type="text"
                                   id="subject" name="subject" value="{{old('subject')}}">
                            <span class="invalid-feedback" role="alert">{{ $errors->first('subject') }}</span>
                        </div>
                        <div class="form-group col-12 col-md-6 col-lg-4">
                            <label for="type">نوع رزرو:</label>
                            <select class="form-control custom-select @error('type') is-invalid @enderror" name="type"
                                    id="type">
                                <option value="">انتخاب کنید:</option>
                                @foreach($types as $type)
                                    <option value="{{$type['id']}}">{{$type['name']}}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" role="alert">{{ $errors->first('type') }}</span>
                        </div>
                        <div class="form-group col-12 col-md-6 col-lg-4">
                            <label for="count">تعداد نفرات:</label>
                            <input class="form-control @error('count') is-invalid @enderror" type="text"
                                   id="count" name="count" value="{{old('count')}}">
                            <span class="invalid-feedback" role="alert">{{ $errors->first('count') }}</span>
                        </div>
                        <span class="invalid-feedback" role="alert">{{ $errors->first('subject') }}</span>
                        <div class="form-group col-12 col-md-6 col-lg-4">
                            <label for="transport">وسیله ایاب و ذهاب:</label>
                            <input class="form-control" type="text"
                                   id="transport" name="transport" value="{{old('transport')}}">
                        </div>
                        <div class="form-group col-12 col-md-6 col-lg-4">
                            <label for="catering_type">نوع پذیرایی:</label>
                            <select class="form-control custom-select @error('catering_type') is-invalid @enderror"
                                    name="catering_type" id="catering_type">
                                <option value="">انتخاب کنید:</option>
                                @foreach($cateringTypes as $cateringType)
                                    <option value="{{$cateringType['id']}}">{{$cateringType['name']}}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" role="alert">{{ $errors->first('catering_type') }}</span>
                        </div>
                        <div class="form-group col-12 col-md-6 col-lg-4">
                            <label for="jDate">تاریخ:</label>
                            <input id="jDate" type="text" data-mddatetimepicker="true" data-placement="top" name="jDate"
                                   class="form-control @error('date') is-invalid @enderror" readonly
                                   value="{{old('jDate')}}">
                            <input type="hidden" name="date" id="date"
                                   value="{{old('date')}}">
                            <span class="invalid-feedback" role="alert">{{ $errors->first('date') }}</span>
                        </div>
                        <div class="form-group col-12 col-md-6 col-lg-4">
                            <label for="duration">مدت زمان:</label>
                            <input class="form-control @error('duration') is-invalid @enderror" type="number" min="0"
                                   id="duration" name="duration" value="{{old('duration')}}">
                            <span class="invalid-feedback" role="alert">{{ $errors->first('duration') }}</span>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-info">ارسال</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
@push('css')
    <style>
        .mds-bootstrap-persian-datetime-picker-container table table tbody.days td[data-day] {
            font-family: IranSans
        }
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function () {
            $('#jDate').MdPersianDateTimePicker({
                dateFormat: 'yyyy/MM/dd HH:mm:ss',
                disableBeforeToday: true,
                enableTimePicker: true,
                targetTextSelector: '#jDate',
                targetDateSelector: '#date'
            });
        });
    </script>
@endpush

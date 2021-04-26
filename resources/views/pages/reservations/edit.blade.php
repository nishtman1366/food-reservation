@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="row">
        <div class="col-12">
            <form action="{{route('reservations.update',['id'=>$reservation->id])}}" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-12 col-md-6 col-lg-4">
                        <label for="first_name">نام:</label>
                        <input class="form-control"
                               disabled
                               value="{{!is_null($reservation->user) ? $reservation->user->first_name : ''}}"
                               type="text" id="first_name"
                               name="first_name">
                    </div>
                    <div class="form-group col-12 col-md-6 col-lg-4">
                        <label for="last_name">نام خانوادگی:</label>
                        <input class="form-control"
                               disabled
                               value="{{!is_null($reservation->user) ? $reservation->user->last_name : ''}}" type="text"
                               id="last_name"
                               name="last_name">
                    </div>
                    <div class="form-group col-12 col-md-6 col-lg-4">
                        <label for="semat">سمت:</label>
                        <input class="form-control"
                               disabled
                               value="{{!is_null($reservation->user) && !is_null($reservation->user->unit) ? $reservation->user->unit->name : ''}}"
                               type="text"
                               id="semat" name="semat">
                    </div>
                    <div class="form-group col-12 col-md-8">
                        <label for="subject">موضوع:</label>
                        <input class="form-control @error('subject') is-invalid @enderror" type="text"
                               {{Auth::user()->level==2 ? 'disabled' : ''}}
                               id="subject" name="subject" value="{{old('subject',$reservation->subject)}}">
                        <span class="invalid-feedback" role="alert">{{ $errors->first('subject') }}</span>
                    </div>
                    <div class="form-group col-12 col-md-6 col-lg-4">
                        <label for="type">نوع رزرو:</label>
                        <select class="form-control custom-select @error('type') is-invalid @enderror" name="type"
                                {{Auth::user()->level==2 ? 'disabled' : ''}}
                                id="type">
                            <option value="">انتخاب کنید:</option>
                            @foreach($types as $type)
                                <option
                                    {{old('type',$reservation->type)==$type['id'] ? 'selected' : ''}} value="{{$type['id']}}">{{$type['name']}}</option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback" role="alert">{{ $errors->first('type') }}</span>
                    </div>
                    <div class="form-group col-12 col-md-6 col-lg-4">
                        <label for="count">تعداد نفرات:</label>
                        <input class="form-control @error('count') is-invalid @enderror" type="text"
                               {{Auth::user()->level==2 ? 'disabled' : ''}}
                               id="count" name="count" value="{{old('count',$reservation->count)}}">
                        <span class="invalid-feedback" role="alert">{{ $errors->first('count') }}</span>
                    </div>
                    <span class="invalid-feedback" role="alert">{{ $errors->first('subject') }}</span>
                    <div class="form-group col-12 col-md-6 col-lg-4">
                        <label for="transport">وسیله ایاب و ذهاب:</label>
                        <input class="form-control" type="text"
                               {{Auth::user()->level==2 ? 'disabled' : ''}}
                               id="transport" name="transport" value="{{old('transport',$reservation->transport)}}">
                    </div>
                    <div class="form-group col-12 col-md-6 col-lg-4">
                        <label for="catering_type">نوع پذیرایی:</label>
                        <select class="form-control custom-select @error('catering_type') is-invalid @enderror"
                                {{Auth::user()->level==2 ? 'disabled' : ''}}
                                name="catering_type" id="catering_type">
                            <option value="">انتخاب کنید:</option>
                            @foreach($cateringTypes as $cateringType)
                                <option
                                    {{old('catering_type',$reservation->catering_type)==$cateringType['id'] ? 'selected' : ''}}  value="{{$cateringType['id']}}">{{$cateringType['name']}}</option>
                            @endforeach
                        </select>
                        <span class="invalid-feedback" role="alert">{{ $errors->first('catering_type') }}</span>
                    </div>
                    <div class="form-group col-12 col-md-6 col-lg-4">
                        <label for="jDate">تاریخ:</label>
                        <input id="jDate" type="text" data-mddatetimepicker="true" data-placement="top" name="jDate"
                               {{Auth::user()->level==2 ? 'disabled' : ''}}
                               class="form-control @error('date') is-invalid @enderror" readonly
                               value="{{old('jDate')}}">
                        <input type="hidden" name="date" id="date"
                               value="{{old('date',$reservation->date)}}">
                        <span class="invalid-feedback" role="alert">{{ $errors->first('date') }}</span>
                    </div>
                    <div class="form-group col-12 col-md-6 col-lg-4">
                        <label for="duration">مدت زمان:</label>
                        <input class="form-control @error('duration') is-invalid @enderror" type="number" min="0"
                               {{Auth::user()->level==2 ? 'disabled' : ''}}
                               id="duration" name="duration" value="{{old('duration',$reservation->duration)}}">
                        <span class="invalid-feedback" role="alert">{{ $errors->first('duration') }}</span>
                    </div>
                    <div class="form-group col-12 col-md-6 col-lg-4">
                        <label for="status">وضعیت:</label>
                        <select class="form-control custom-select @error('status') is-invalid @enderror"
                                {{Auth::user()->level==2 ? 'disabled' : ''}}
                                name="status" id="catering_type">
                            <option value="">انتخاب کنید:</option>
                            @foreach($statues as $status)
                                <option
                                    {{old('status',$reservation->status)==$status['id'] ? 'selected' : ''}}  value="{{$status['id']}}">{{$status['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description"
                                  {{Auth::user()->level==2 ? 'disabled' : ''}}
                                  name="description">{{old('description',$reservation->description)}}</textarea>
                    </div>
                    @if(Auth::user()->level==1)
                        <div class="col-12">
                            <button class="btn btn-info">ارسال</button>
                        </div>
                    @endif
                </div>
            </form>
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

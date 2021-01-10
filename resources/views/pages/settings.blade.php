@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6 m-auto">
            <form action="{{route('settings.update')}}" method="post">
                @csrf
                @foreach($settings as $item)
                    <div class="form-group">
                        <label for="{{$item->key}}"><h5>{{$item->name}}</h5></label>
                        @if($item->key=='ALLOW_ORDER_ALL_TIME')
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-info border-left-0 {{$item->value==1 ? 'active' : ''}}"
                                       style="border-radius: 0 3px 3px 0;" id="{{$item->key}}-yes-label">
                                    <input type="radio" name="{{$item->key}}" value="1" id="{{$item->key}}-yes-radio"
                                           autocomplete="off" {{$item->value==1 ? 'checked' : ''}}>بله
                                </label>
                                <label class="btn btn-outline-info {{$item->value==0 ? 'active' : ''}}"
                                       style="border-radius: 3px 0 0 3px;" id="{{$item->key}}-no-label">
                                    <input type="radio" name="{{$item->key}}" value="0" id="{{$item->key}}-no-radio"
                                           autocomplete="off" {{$item->value==0 ? 'checked' : ''}}>
                                    خیر
                                </label>
                            </div>
                        @else
                            <input type="text" name="{{$item->key}}" id="{{$item->key}}" value="{{$item->value}}"
                                   class="form-control">

                        @endif
                    </div>
                @endforeach
                <div class="dropdown-divider"></div>
                <button class="btn btn-success">ذخیره اطلاعات</button>
            </form>
        </div>
    </div>

@endsection

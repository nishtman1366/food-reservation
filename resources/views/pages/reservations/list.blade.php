@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="row">
        @if(!is_null(old('message')))
            <div class="col-12">
                <h4 class="text-center text-success">{{old('message')}}</h4>
            </div>
        @endif
        <div class="col-12">
            <table class="table table-striped table-hover">
                <tr>
                    <th scope="col">ردیف</th>
                    <th scope="col">درخواست کننده</th>
                    <th scope="col">نوع رزرو</th>
                    <th scope="col">زمان رزرو</th>
                    <th scope="col">تاریخ درخواست</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">عملیات</th>
                </tr>
                @php($i=1)
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{!is_null($reservation->user) ? $reservation->user->first_name.' '.$reservation->user->last_name : '--'}}</td>
                        <td>{{$reservation->typeText}}</td>
                        <td>{{$reservation->jDate}}</td>
                        <td>{{$reservation->jCreatedDate}}</td>
                        <td>{{$reservation->statusText}}</td>
                        <td>
                            <a href="{{route('reservations.view',['id'=>$reservation->id])}}"
                               class="btn btn-outline-primary"><i
                                    class="fa fa-pencil"></i></a>
                            @if(Auth::user()->level==1)
                                <a href="{{route('reservations.delete',['id'=>$reservation->id])}}"
                                   class="btn btn-outline-danger"><i
                                        class="fa fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                    @php($i++)
                @endforeach
                <tr>
                    <td colspan="7">{{$reservations->links()}}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection

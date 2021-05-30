@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="row">
        <div class="col-12 text-left">
            <a href="{{route('surveys.questions.create')}}" class="btn btn-info">ایجاد سوال جدید</a>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <tr>
            <th scope="col">ردیف</th>
            <th scope="col">سوال</th>
            <th scope="col">وضعیت</th>
            <th scope="col">تاریخ ایجاد</th>
            <th scope="col">گزینه ها</th>
            <th scope="col">پاسخ ها</th>
            <th scope="col">عملیات</th>
        </tr>
        @php($i=1)
        @foreach($questions as $question)
            <tr>
                <td>{{$i}}</td>
                <td>{{$question['title']}}</td>
                <td>{{$question['statusText']}}</td>
                <td>{{$question['jDate']}}</td>
                <td>{{$question->answers->count()}}</td>
                <td>{{$question['usersAnswersCount']}}</td>
                <td>
                    <a href="{{route('surveys.questions.view',['id'=>$question->id])}}"
                       class="btn btn-outline-primary edit-user"><i
                            class="fa fa-pencil"></i></a>
                    <a href="{{route('surveys.questions.delete',['id'=>$question->id])}}"
                       class="btn btn-outline-danger"><i
                            class="fa fa-trash"></i></a>
                    <a href="{{route('surveys.questions.stats',['id'=>$question->id])}}"
                       class="btn btn-outline-success"><i
                            class="fa fa-bar-chart"></i></a>
                </td>
            </tr>
            @php($i++)
        @endforeach
    </table>
@endsection

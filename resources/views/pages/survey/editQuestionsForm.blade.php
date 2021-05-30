@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="row">
        <div class="col-12 col-md-8 col-xl-6 mx-auto">
            <form id="questionsForm" action="{{route('surveys.questions.update',['id'=>$question->id])}}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="title">عنوان سوال</label>
                    <input class="form-control" type="text" name="title" value="{{old('title',$question->title)}}"
                           id="title">
                </div>
                <div class="text-right">وضعیت  سوال</div>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-outline-success border-left-0 {{$question->status==true ? 'active' : ''}}"
                           style="border-radius: 0 3px 3px 0;" id="status-yes-label">
                        <input type="radio" name="status" value="1" id="status-yes-radio"
                               autocomplete="off" {{$question->status==true ? 'checked' : ''}}>فعال
                    </label>
                    <label class="btn btn-outline-danger {{$question->status==false ? 'active' : ''}}"
                           style="border-radius: 3px 0 0 3px;" id="status-no-label">
                        <input type="radio" name="status" value="0" id="status-no-radio"
                               autocomplete="off" {{$question->status==false ? 'checked' : ''}}>
                        غیرفعال
                    </label>
                </div>
                <div id="answers">
                    @foreach($question->answers as $answer)
                        <div class="form-group">
                            <label for="answer_{{$answer->id}}">متن گزینه:</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <input class="form-control" type="text" name="answers[{{$answer->id}}]"
                                       value="{{$answer->answer}}"
                                       id="answer_{{$answer->id}}">
                                <div class="input-group-append">
                                    <div class="input-group-text delete-answer"
                                         data-answer-id="{{$answer->id}}"
                                         style="cursor:pointer">
                                        حذف
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button id="addAnswer" type="button" class="btn btn-info">اضافه کردن گزینه جدید</button>
                <button class="btn btn-success">ذخیره</button>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            var i = 1000000;
            $("#addAnswer").click(function () {
                $("#answers").append('<div class="form-group">' +
                    '<label for="answer_' + i + '">متن گزینه:</label>' +
                    '<div class="input-group mb-2 mr-sm-2">\n' +
                    '    <input class="form-control" type="text" name="new_answers[]" value="" id="answer_' + i + '">\n' +
                    '    <div class="input-group-append">\n' +
                    '      <div class="input-group-text delete-answer" style="cursor:pointer">حذف</div>\n' +
                    '    </div>\n' +
                    '  </div>' +
                    '</div>');

                $(".delete-answer").click(function () {
                    $(this).parent().parent().parent().remove();
                });

                i++;
            });

            $(".delete-answer").click(function () {
                let id = $(this).data('answer-id');
                if (id) {
                    $("#questionsForm").append('<input type="hidden" name="delete_answers[]" value="' + id + '">');
                }
                $(this).parent().parent().parent().remove();
            });
        });
    </script>
@endpush

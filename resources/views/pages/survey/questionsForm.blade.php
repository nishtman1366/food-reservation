@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="row">
        <div class="col-12 col-md-8 col-xl-6 mx-auto">
            <form action="{{route('surveys.questions.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">عنوان سوال</label>
                    <input class="form-control" type="text" name="title" value="{{old('title')}}" id="title">
                </div>
                <div id="answers">
                    <div class="form-group">
                        <label for="answer_1">متن گزینه:</label>
                        <input class="form-control" type="text" name="answers[]" value="{{old('answers[0]')}}"
                               id="answer_1">
                    </div>
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
            var i = 2;
            $("#addAnswer").click(function () {
                $("#answers").append('<div class="form-group">' +
                    '<label for="answer_' + i + '">متن گزینه:</label>' +
                    '<div class="input-group mb-2 mr-sm-2">\n' +
                    '    <input class="form-control" type="text" name="answers[]" value="" id="answer_' + i + '">\n' +
                    '    <div class="input-group-append">\n' +
                    '      <div id="delete-answer_' + i + '" class="input-group-text" style="cursor:pointer">حذف</div>\n' +
                    '    </div>\n' +
                    '  </div>' +
                    '</div>');

                $("#delete-answer_" + i).click(function () {
                    $(this).parent().parent().parent().remove();
                });
                i++;
            });
        });
    </script>
@endpush

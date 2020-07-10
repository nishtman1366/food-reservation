@extends('layouts.dashboard')

@section('dashboard_content')
    <button class="btn btn-info m-1" id="new-popup-btn">ثبت اطلاعیه جدید</button>
    <table id="food-table" class="table table-hover">
        <thead>
        <tr>
            <th scope="col">ردیف</th>
            <th scope="col">تیتر</th>
            <th scope="col">زمان نمایش</th>
            <th scope="col">وضعیت نمایش</th>
            <th scope="col">عملیات</th>
        </tr>
        </thead>
        <tbody>
        @php($i=1)
        @foreach($popups as $popup)
            @php(substr($popup->body,0,10))
            <tr id="popup-row-{{$popup->id}}">
                <td>{{$i}}</td>
                <td>{{$popup->title}}</td>
                <td>{{$popup->startJDate}} تا {{$popup->endJDate}}</td>
                <td>{{$popup->status}}</td>
                <td>
                    <button class="btn btn-outline-primary edit-popup" data-popup-id="{{$popup->id}}"><i
                            class="fa fa-pencil"></i></button>
                    <button class="btn btn-outline-danger delete-popup" data-popup-id="{{$popup->id}}"><i
                            class="fa fa-trash"></i></button>
                </td>
            </tr>
            @php($i++)
        @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="new-popup-Modal" tabindex="-1" role="dialog" aria-labelledby="new-popup-ModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-popup-ModalLabel">ثبت اطلاعات غذا</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">تیتر اطلاعیه</label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="body">متن اطلاعیه</label>
                        <textarea name="body" id="body" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="start">تاریخ شروع نمایش</label>
                        <input type="text" name="start" id="start" class="form-control">
                        <input type="hidden" name="startGDate" id="startGDate" value="" autocomplete="off">

                    </div>
                    <div class="form-group">
                        <label for="end">تاریخ پایان نمایش</label>
                        <input type="text" name="end" id="end" class="form-control">
                        <input type="hidden" name="endGDate" id="endGDate" value="" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-primary d-none" id="new-popup">ذخیره اطلاعات</button>
                    <button type="button" class="btn btn-primary d-none" id="edit-popup">بروزرسانی اطلاعات</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#new-popup-btn").click(function () {
                $('#start').MdPersianDateTimePicker({
                    disableBeforeToday: true,
                    enableTimePicker: true,
                    targetTextSelector: '#start',
                    targetDateSelector: '#startGDate'
                });
                $('#end').MdPersianDateTimePicker({
                    disableBeforeToday: true,
                    enableTimePicker: true,
                    targetTextSelector: '#end',
                    targetDateSelector: '#endGDate'
                });
                $("#new-popup-Modal").modal('toggle');
                $("#edit-food").addClass('d-none');
                $("#new-popup").removeClass('d-none');
            });
            $('#new-popup').bind('click', function () {
                let title = $("#title").val();
                let body = $("#body").val();
                let start = $("#startGDate").val();
                let end = $("#endGDate").val();
                $(this).prop('disabled', true);
                $(this).text('درحال ارسال اطلاعات...');
                $("#loading").addClass('d-flex');
                Axios.post('admin/popups', {title, body, start, end})
                    .then(function (response) {
                        toastr.success('با موفقیت انجام شد.');
                        $("#new-popup-Modal").modal('toggle');
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                    })
                    .catch(function (error) {
                        $(this).prop('disabled', false);
                        $(this).text('ذخیره اطلاعات');
                        toastr.error('به علت اشکال داخلی انجام نشد.');
                        console.log(error.response.data);
                    })
                    .finally(function () {
                        $("#loading").removeClass('d-flex');
                    });
            });

            $('.edit-popup').click(function () {
                $('#start').MdPersianDateTimePicker({
                    disableBeforeToday: true,
                    enableTimePicker: true,
                    targetTextSelector: '#start',
                    targetDateSelector: '#startGDate'
                });
                $('#end').MdPersianDateTimePicker({
                    disableBeforeToday: true,
                    enableTimePicker: true,
                    targetTextSelector: '#end',
                    targetDateSelector: '#endGDate'
                });
                let id = $(this).attr('data-popup-id');
                let popup;
                $("#loading").addClass('d-flex');
                Axios.get('admin/popups/' + id)
                    .then(function (response) {
                        popup = response.data;
                        $("#title").val(popup.title);
                        $("#body").val(popup.body);
                        $("#start").val(popup.startJDate);
                        $("#end").val(popup.endJDate);
                        $("#new-popup-Modal").modal('toggle');
                        $("#new-popup").addClass('d-none');
                        $("#edit-popup").removeClass('d-none');
                        $("#edit-popup").click(function () {
                            let title = $("#title").val();
                            let body = $("#body").val();
                            let start = $("#startGDate").val();
                            let end = $("#endGDate").val();
                            $(this).prop('disabled', true);
                            $(this).text('درحال ارسال اطلاعات...');
                            Axios.put('admin/popups/' + id, {title, body, start, end})
                                .then(function (reponse) {
                                    toastr.success('با موفقیت انجام شد.');
                                    $("#new-popup-Modal").modal('toggle');
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 1000);
                                })
                                .catch(function (error) {
                                    $(this).prop('disabled', false);
                                    $(this).text('ذخیره اطلاعات');
                                    toastr.error('به علت اشکال داخلی انجام نشد.');
                                    console.log(error.response.data);
                                })
                                .finally(function () {
                                    $("#loading").removeClass('d-flex');
                                })

                        });
                    })
                    .catch(function (error) {
                        toastr.error('اطلاعات وارد شده اشتباه است');
                    })
                    .finally(function () {
                        $("#loading").removeClass('d-flex');
                    });
            });

            $('.delete-popup').click(function () {
                let id = $(this).attr('data-popup-id');
                toastr.warning('آیا از حذف این مورد مطمئن هستید؟' +
                    '<br>' +
                    '<button id="confirm-delete" class="btn btn-danger m-1">بله</button>' +
                    '<button class="btn btn-secondary clear m-1">خیر</button>');
                $("#confirm-delete").click(function () {
                    $("#loading").addClass('d-flex');
                    Axios.delete('admin/popups/' + id)
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                            $("#menu-row-" + id).remove();
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        })
                        .catch(function (error) {
                            toastr.error('به علت اشکال داخلی انجام نشد.');
                        })
                        .finally(function () {
                            $("#loading").removeClass('d-flex');
                        });
                });
            });
        });
    </script>
@endpush

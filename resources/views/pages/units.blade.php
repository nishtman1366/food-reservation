@extends('layouts.dashboard')

@section('dashboard_content')
    <button class="btn btn-info m-1" id="new-unit-btn">ثبت واحد جدید</button>
    <table class="table table-striped table-hover">
        <tr>
            <th scope="col">ردیف</th>
            <th scope="col">نام</th>
            <th scope="col">تعداد پرسنل</th>
            <th scope="col">عملیات</th>
        </tr>
        @php($i=1)
        @foreach($units as $unit)
            <tr>
                <td>{{$i}}</td>
                <td>{{$unit['name']}}</td>
                <td class="persian-numbers">{{$unit['users_count']}} نفر</td>
                <td>
                    <button class="btn btn-outline-primary edit-unit" data-unit-id="{{$unit['id']}}"><i
                            class="fa fa-pencil"></i></button>
                    <button class="btn btn-outline-danger delete-unit" data-unit-id="{{$unit['id']}}"><i
                            class="fa fa-trash"></i></button>
                </td>
            </tr>
            @php($i++)
        @endforeach
    </table>
    <div class="modal fade" id="new-unit-Modal" tabindex="-1" role="dialog" aria-labelledby="new-unit-ModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-unit-ModalLabel">ثبت اطلاعات واحد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">نام</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-primary d-none" id="new-unit">ذخیره اطلاعات</button>
                    <button type="button" class="btn btn-primary d-none" id="edit-unit">بروزرسانی اطلاعات</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#new-unit-btn").click(function () {
                $("#new-unit-Modal").modal('toggle');
                $("#edit-unit").addClass('d-none');
                $("#new-unit").removeClass('d-none');
                $('#new-unit').click(function () {
                    let name = $('#name').val();
                    $(this).prop('disabled', true);
                    $(this).text('درحال ارسال اطلاعات...');
                    $("#loading").addClass('d-flex');
                    Axios.post('units', {name})
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                            $("#new-unit-Modal").modal('toggle');
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        })
                        .catch(function (error) {
                            $(this).prop('disabled', false);
                            $(this).text('ذخیره اطلاعات');
                            toastr.error('به علت اشکال داخلی انجام نشد.');
                        })
                        .finally(function () {
                            $("#loading").removeClass('d-flex');
                        });
                });
            });

            $('.edit-unit').click(function () {
                let id = $(this).attr('data-unit-id');
                $("#loading").addClass('d-flex');
                Axios.get('units/' + id)
                    .then(function (response) {
                        $("#name").val(response.data.name);
                    })
                    .catch(function (error) {
                        toastr.error('به علت اشکال داخلی انجام نشد.');
                    })
                    .finally(function () {
                        $("#loading").removeClass('d-flex');
                    });
                $("#new-unit-Modal").modal('toggle');
                $("#new-unit").addClass('d-none');
                $("#edit-unit").removeClass('d-none');
                $('#edit-unit').click(function () {
                    let name = $('#name').val();
                    $("#loading").addClass('d-flex');
                    Axios.put('units/' + id, {name})
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        })
                        .catch(function (error) {
                            toastr.error('به علت اشکال داخلی انجام نشد.');
                        })
                        .finally(function () {
                            $("#new-unit-Modal").modal('toggle');
                            $("#loading").removeClass('d-flex');
                        });
                });
            });

            $('.delete-unit').click(function () {
                let id = $(this).attr('data-unit-id');
                toastr.warning('آیا از حذف این مورد مطمئن هستید؟' +
                    '<br>' +
                    '<button id="confirm-delete" class="btn btn-danger m-1">بله</button>' +
                    '<button class="btn btn-secondary clear m-1">خیر</button>');
                $("#confirm-delete").click(function () {
                    $("#loading").addClass('d-flex');
                    Axios.delete('units/' + id)
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
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

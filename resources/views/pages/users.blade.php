@extends('layouts.dashboard')

@section('dashboard_content')
    <button class="btn btn-info m-1" id="new-user-btn">ثبت کاربر جدید</button>
    <table class="table table-hover">
        <tr>
            <th scope="col">ردیف</th>
            <th scope="col">نام</th>
            <th scope="col">نام کاربری</th>
            <th scope="col">شماره پرسنلی</th>
            <th scope="col">شماره ملی</th>
            <th scope="col">عملیات</th>
        </tr>
        @php($i=1)
        @foreach($users as $user)
            <tr>
                <td>{{$i}}</td>
                <td>{{$user['first_name'].' '.$user['last_name']}}</td>
                <td>{{$user['username']}}</td>
                <td>{{$user['personal_code']}}</td>
                <td>{{$user['national_code']}}</td>
                <td>
                    <button class="btn btn-outline-primary edit-user" data-user-id="{{$user['id']}}"><i
                            class="fa fa-pencil"></i></button>
                    <button class="btn btn-outline-danger delete-user" data-user-id="{{$user['id']}}"><i
                            class="fa fa-trash"></i></button>
                </td>
            </tr>
            @php($i++)
        @endforeach
        <tr>
            <td colspan="6">{{$users->links()}}</td>
        </tr>
    </table>
    <div class="modal fade" id="new-user-Modal" tabindex="-1" role="dialog" aria-labelledby="new-user-ModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-user-ModalLabel">ثبت اطلاعات کاربر</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="first_name">نام</label>
                        <input type="text" name="first_name" id="first_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="last_name">نام خانوادگی</label>
                        <input type="text" name="last_name" id="last_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="national_code">شماره ملی</label>
                        <input type="text" name="national_code" id="national_code" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="personal_code">شماره پرسنلی</label>
                        <input type="text" name="personal_code" id="personal_code" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-primary d-none" id="new-user">ذخیره اطلاعات</button>
                    <button type="button" class="btn btn-primary d-none" id="edit-user">بروزرسانی اطلاعات</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#new-user-btn").click(function () {
                $("#new-user-Modal").modal('toggle');
                $("#edit-user").addClass('d-none');
                $("#new-user").removeClass('d-none');
                $('#new-user').click(function () {
                    let first_name = $('#first_name').val();
                    let last_name = $('#last_name').val();
                    let national_code = $('#national_code').val();
                    let personal_code = $('#personal_code').val();
                    Axios.post('users', {first_name, last_name, national_code, personal_code})
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                        })
                        .catch(function (error) {
                            toastr.error('به علت اشکال داخلی انجام نشد.');
                        })
                        .finally(function () {
                            $("#new-user-Modal").modal('toggle');
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        });
                });
            });

            $('.edit-user').click(function () {
                let id = $(this).attr('data-user-id');
                Axios.get('users/' + id)
                    .then(function (response) {
                        $("#first_name").val(response.data.first_name);
                        $("#last_name").val(response.data.last_name);
                        $("#national_code").val(response.data.national_code);
                        $("#personal_code").val(response.data.personal_code);
                    })
                    .catch(function (error) {
                        toastr.error('به علت اشکال داخلی انجام نشد.');
                    })
                    .finally(function () {

                    });
                $("#new-user-Modal").modal('toggle');
                $("#new-user").addClass('d-none');
                $("#edit-user").removeClass('d-none');
                $('#edit-user').click(function () {
                    let first_name = $('#first_name').val();
                    let last_name = $('#last_name').val();
                    let national_code = $('#national_code').val();
                    let personal_code = $('#personal_code').val();
                    Axios.put('users/' + id, {first_name, last_name, national_code, personal_code})
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                        })
                        .catch(function (error) {
                            toastr.error('به علت اشکال داخلی انجام نشد.');
                        })
                        .finally(function () {
                            $("#new-user-Modal").modal('toggle');
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        });
                });
            });

            $('.delete-user').click(function () {
                let id = $(this).attr('data-user-id');
                toastr.warning('آیا از حذف این مورد مطمئن هستید؟' +
                    '<br>' +
                    '<button id="confirm-delete" class="btn btn-danger m-1">بله</button>' +
                    '<button class="btn btn-secondary clear m-1">خیر</button>');
                $("#confirm-delete").click(function () {
                    Axios.delete('users/' + id)
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                        })
                        .catch(function (error) {
                            toastr.error('به علت اشکال داخلی انجام نشد.');
                        })
                        .finally(function () {
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        });
                });
            });
        });
    </script>
@endpush

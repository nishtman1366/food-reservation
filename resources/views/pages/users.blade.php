@extends('layouts.dashboard')

@section('dashboard_content')
    <form action="{{route('users.list')}}" method="post">
        @csrf
        <div class="input-group">
            <span class="input-group-text border-left-0" style="border-top-left-radius: 0;border-bottom-left-radius: 0;">جستجو: </span>
            <input class="form-control border-right-0 border-left-0" style="border-radius: 0;" type="text" name="searchQuery" value="{{old('searchQuery',null)}}">
            <button class="btn btn-primary border-right-0 border-left-0" style="border-radius: 0;">جستجو</button>
            <button type="button" class="btn btn-info border-right-0" style="border-top-right-radius: 0;border-bottom-right-radius: 0;" id="new-user-btn">ثبت کاربر جدید</button>
        </div>
    </form>
    <table class="table table-striped table-hover">
        <tr>
            <th scope="col">ردیف</th>
            <th scope="col">نام</th>
            <th scope="col">واحد شغلی</th>
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
                <td>{{!is_null($user->unit) ? $user->unit->name : '--'}}</td>
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
                        <label for="unit">واحد شغلی</label>
                        <select name="unit" id="unit" class="form-control">
                            <option value="">انتخاب کنید:</option>
                            @foreach($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                            @endforeach
                        </select>
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
                    let user_units_id = $('#unit').val();
                    let national_code = $('#national_code').val();
                    let personal_code = $('#personal_code').val();
                    $(this).prop('disabled', true);
                    $(this).text('درحال ارسال اطلاعات...');
                    $("#loading").addClass('d-flex');
                    Axios.post('users', {first_name, last_name, user_units_id, national_code, personal_code})
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                            $("#new-user-Modal").modal('toggle');
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

            $('.edit-user').click(function () {
                let id = $(this).attr('data-user-id');
                $("#loading").addClass('d-flex');
                Axios.get('users/' + id)
                    .then(function (response) {
                        $("#first_name").val(response.data.first_name);
                        $("#last_name").val(response.data.last_name);
                        $("#unit").val(response.data.user_units_id);
                        $("#national_code").val(response.data.national_code);
                        $("#personal_code").val(response.data.personal_code);
                    })
                    .catch(function (error) {
                        toastr.error('به علت اشکال داخلی انجام نشد.');
                    })
                    .finally(function () {
                        $("#loading").removeClass('d-flex');
                    });
                $("#new-user-Modal").modal('toggle');
                $("#new-user").addClass('d-none');
                $("#edit-user").removeClass('d-none');
                $('#edit-user').click(function () {
                    let first_name = $('#first_name').val();
                    let last_name = $('#last_name').val();
                    let user_units_id = $('#unit').val();
                    let national_code = $('#national_code').val();
                    let personal_code = $('#personal_code').val();
                    $("#loading").addClass('d-flex');
                    Axios.put('users/' + id, {first_name, last_name, user_units_id, national_code, personal_code})
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
                            $("#new-user-Modal").modal('toggle');
                            $("#loading").removeClass('d-flex');
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
                    $("#loading").addClass('d-flex');
                    Axios.delete('users/' + id)
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

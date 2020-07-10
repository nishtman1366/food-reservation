@extends('layouts.dashboard')

@section('dashboard_content')
    <button class="btn btn-info m-1" id="new-food-btn">ثبت غذای جدید</button>
    <table id="food-table" class="table table-hover">
        <thead>
        <tr>
            <th scope="col">ردیف</th>
            <th scope="col">نام</th>
            <th scope="col">تصویر</th>
            <th scope="col">توضیحات</th>
            <th scope="col">عملیات</th>
        </tr>
        </thead>
        <tbody>
        @php($i=1)
        @foreach($foods as $food)
            <tr id="food-row-{{$food->id}}">
                <td>{{$i}}</td>
                <td>{{$food['name']}}</td>
                <td><a href="{{url('storage/foods/'.$food['image'])}}" target="_blank">مشاهده</a></td>
                <td>{{$food['description']}}</td>
                <td>
                    <button class="btn btn-outline-primary edit-food" data-food-id="{{$food['id']}}"><i
                            class="fa fa-pencil"></i></button>
                    <button class="btn btn-outline-danger delete-food" data-food-id="{{$food['id']}}"><i
                            class="fa fa-trash"></i></button>
                </td>
            </tr>
            @php($i++)
        @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="new-food-Modal" tabindex="-1" role="dialog" aria-labelledby="new-food-ModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-food-ModalLabel">ثبت اطلاعات غذا</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">نام غذا</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image">تصویر غذا</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">توضیحات غذا</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-primary d-none" id="new-food">ذخیره اطلاعات</button>
                    <button type="button" class="btn btn-primary d-none" id="edit-food">بروزرسانی اطلاعات</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#new-food-btn").click(function () {
                $("#new-food-Modal").modal('toggle');
                $("#edit-food").addClass('d-none');
                $("#new-food").removeClass('d-none');
                $('#new-food').click(function () {
                    let name = $('#name').val();
                    let image = $('#image');
                    let description = $('#description').val();
                    let formData = new FormData();
                    formData.append("name", name);
                    formData.append("file", image[0].files[0]);
                    formData.append("description", description);
                    $("#loading").addClass('d-flex');
                    Axios.post('foods', formData, {headers: {'Content-Type': 'multipart/form-data'}})
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

            $('.edit-food').click(function () {
                let id = $(this).attr('data-food-id');
                let row = $('#food-row-' + id);
                let name = row.children(':first').next().html();
                let description = row.children(':first').next().next().next().html();
                $("#new-food-Modal").modal('toggle');
                $("#name").val(name);
                let image = $('#image');
                $("#description").val(description);
                $("#new-food").addClass('d-none');
                $("#edit-food").removeClass('d-none');
                $('#edit-food').click(function () {
                    $("#loading").addClass('d-flex');
                    let name = $('#name').val();
                    let image = $('#image');
                    let description = $('#description').val();
                    let formData = new FormData();
                    formData.append("name", name);
                    formData.append("file", image[0].files[0]);
                    formData.append("description", description);
                    Axios.post('foods/' + id, formData, {headers: {'Content-Type': 'multipart/form-data'}})
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

            $('.delete-food').click(function () {
                let id = $(this).attr('data-food-id');
                toastr.warning('آیا از حذف این مورد مطمئن هستید؟' +
                    '<br>' +
                    '<button id="confirm-delete" class="btn btn-danger m-1">بله</button>' +
                    '<button class="btn btn-secondary clear m-1">خیر</button>');
                $("#loading").addClass('d-flex');
                $("#confirm-delete").click(function () {
                    Axios.delete('foods/' + id)
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

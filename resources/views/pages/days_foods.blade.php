@extends('layouts.dashboard')

@section('dashboard_content')
    <button class="btn btn-info m-1" id="new-menu-btn">ثبت منوی جدید</button>


    <div class="modal fade" id="new-menu-Modal" tabindex="-1" role="dialog" aria-labelledby="new-menu-ModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-menu-ModalLabel">ثبت اطلاعات منو</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date">انتخاب تاریخ</label>
                        <input type="text" class="form-control" name="date" id="date">
                    </div>
                    <div class="form-group">
                        <ul>
                            <li></li>
                        </ul>
                        <button class="btn btn-info" id="list-foods"><i class="fa fa-plus"></i></button>
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
    <div class="modal fade" id="list-foods-Modal" tabindex="-1" role="dialog" aria-labelledby="list-foods-ModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="list-foods-ModalLabel">لیست غذاها</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(!is_null($foods) && count($foods) > 0)
                        <div class="row">
                            @foreach($foods as $food)
                                <div class="col-4 m-auto">
                                    <div class="border rounded m-1">
                                        <p class="text-center">{{$food->name}}</p>
                                        <div class="btn-group-toggle m-auto" data-toggle="buttons">
                                            <label class="btn btn-secondary active">
                                                <input type="checkbox" name="food-{{$food->id}}" class="foods"
                                                       autocomplete="off"> انتخاب
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h3 class="text-center alert alert-info">هیچ غذایی ثبت نشده است</h3>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-primary" id="new-food">انتخاب</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#new-menu-btn").click(function () {
                $("#new-menu-Modal").modal('toggle');
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
                    Axios.post('foods', formData, {headers: {'Content-Type': 'multipart/form-data'}})
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                        })
                        .catch(function (error) {
                            toastr.error('به علت اشکال داخلی انجام نشد.');
                        })
                        .finally(function () {
                            $("#new-food-Modal").modal('toggle');
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        });
                });
            });

            $("#list-foods").click(function () {
                $("#list-foods-Modal").modal('toggle');
            })

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
                        })
                        .catch(function (error) {
                            toastr.error('به علت اشکال داخلی انجام نشد.');
                        })
                        .finally(function () {
                            $("#new-food-Modal").modal('toggle');
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        });
                });
            });

            $('.delete-food').click(function () {
                let id = $(this).attr('data-food-id');
                toastr.warning('آیا از حذف این مورد مطمئن هستید؟' +
                    '<br>' +
                    '<button id="confirm-delete" class="btn btn-danger m-1">بله</button>' +
                    '<button class="btn btn-secondary clear m-1">خیر</button>');
                $("#confirm-delete").click(function () {
                    Axios.delete('foods/' + id)
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                            $("#food-row-" + id).remove();
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

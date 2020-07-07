@extends('layouts.dashboard')

@section('dashboard_content')
    <button class="btn btn-info m-1" id="new-menu-btn">ثبت منوی جدید</button>
    <div class="row">
        @if(!is_null($dayFoods) && count($dayFoods) > 0)
            @foreach($dayFoods as $dayFood)
                <div id="menu-row-{{str_replace('/','-',$dayFood['jDate'])}}" class="col-12">
                    <div class="row border rounded m-1" style="height: 100px">
                        <div class="col-4 text-center d-flex flex-column">
                            <div class="p-2 persian-numbers">{{$dayFood['jDate']}}<br>{{$dayFood['weekday']}}</div>
                            <div class="p-2">
                                <i data-date="{{$dayFood['jDate']}}" class="fa fa-trash text-danger delete-menu"
                                   style="cursor: pointer"></i>
                            </div>
                        </div>
                        <div class="col-4 text-right">
                            <h5 class="border-bottom text-center">ناهار</h5>
                            <div class="row">
                                @foreach($dayFood['lunch'] as $item)
                                    <div class="col-6 text-muted text-small text-nowrap">
                                        <i class="fa fa-cutlery"></i> {{$item->food->name}}
                                    </div>
                                @endforeach
                                <div class="col-12 text-center">
                                    <i
                                        style="cursor: pointer"
                                        data-jDate="{{$dayFood['jDate']}}"
                                        data-gDate="{{$dayFood['gDate']}}" class="fa fa-pencil text-primary edit-menu"
                                        data-type="1"
                                        data-lunchIds="{{$dayFood['lunchIds']}}"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-right">
                            <h5 class="border-bottom text-center">شام</h5>
                            <div class="row">
                                @foreach($dayFood['dinner'] as $item)
                                    <div class="col-6 text-muted text-small text-nowrap">
                                        <i class="fa fa-cutlery"></i> {{$item->food->name}}
                                    </div>
                                @endforeach
                                <div class="col-12 text-center">
                                    <i
                                        style="cursor: pointer"
                                        data-jDate="{{$dayFood['jDate']}}"
                                        data-gDate="{{$dayFood['gDate']}}" class="fa fa-pencil text-primary edit-menu"
                                        data-type="2"
                                        data-dinnerIds="{{$dayFood['dinnerIds']}}"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3 class="col-12 text-info text-center">موردی برای نمایش یافت نشد.</h3>
        @endif
    </div>
    <div class="modal fade" id="new-menu-Modal" tabindex="-1" role="dialog" aria-labelledby="new-menu-ModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="new-menu-ModalLabel">ثبت اطلاعات منو</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jDate">انتخاب تاریخ</label>
                        <input type="text" class="form-control" name="jDate" id="jDate" readonly>
                        <input type="hidden" name="gDate" id="gDate" value="">
                    </div>
                    <div class="btn-group btn-group-toggle pull-right" data-toggle="buttons">
                        <label class="btn btn-outline-info border-left-0"
                               style="border-radius: 0 3px 3px 0;" id="lunch-label">
                            <input type="radio" name="type" value="1" id="lunch-radio" class="type" autocomplete="off">
                            ناهار
                        </label>
                        <label class="btn btn-outline-info"
                               style="border-radius: 3px 0 0 3px;" id="dinner-label">
                            <input type="radio" name="type" value="2" id="dinner-radio" class="type" autocomplete="off">
                            شام
                        </label>
                    </div>
                    <div class="form-group pull-left">
                        <button class="btn btn-info" id="list-foods"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <ul class="m-1" style="list-style-type: none" id="selected-foods-list"></ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" class="btn btn-primary submit-button" id="new-menu">ذخیره اطلاعات</button>
                    <button type="button" class="btn btn-primary submit-button" id="edit-menu">بروزرسانی اطلاعات
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="list-foods-Modal" tabindex="-1" role="dialog" aria-labelledby="list-foods-ModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" role="document">
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
                                <div class="col-2 m-auto">
                                    <div class="border rounded m-1">
                                        <img src="{{url('storage/foods').'/'.$food->image}}" class="w-100">
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-outline-secondary d-block m-auto">
                                                <input type="checkbox" name="food-{{$food->id}}" class="foods"
                                                       autocomplete="off"
                                                       data-food-id="{{$food->id}}"
                                                       data-food-name="{{$food->name}}"
                                                       value="{{$food->id}}"> انتخاب
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
                    <button type="button" class="btn btn-primary" id="select-foods">انتخاب</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('#jDate').MdPersianDateTimePicker({
                disableBeforeToday: true,
                targetTextSelector: '#jDate',
                targetDateSelector: '#gDate'
            });

            var foodsList = [];
            $("#new-menu-btn").click(function () {
                $("#new-menu-Modal").modal('toggle');
                $("#edit-menu").addClass('d-none');
                $("#new-menu").removeClass('d-none');
            });

            $("#new-menu").bind('click', function () {
                let jDate = $('#jDate').val();
                let gDate = $('#gDate').val();
                let type = $(".type:checked").val();
                if (gDate.length === 0) {
                    toastr.error('لطفا تاریخ را انتخاب کنید.');
                } else if (parseInt(type) !== 1 && parseInt(type) !== 2) {
                    toastr.error('لطفا وعده غذایی را انتخاب کنید.');
                } else if (foodsList.length === 0) {
                    toastr.error('لطفا لیست غذاها را انتخاب کنید.');
                } else {
                    $(this).prop('disabled', true);
                    $(this).text('درحال ارسال اطلاعات...');
                    Axios.post('days-foods', {gDate, type, foodsList})
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                            $("#menu").modal('toggle');
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        })
                        .catch(function (error) {
                            toastr.error('به علت اشکال داخلی انجام نشد.');
                        })
                        .finally(function () {

                        });
                }

            });
            var jDate, gDate, type;
            $(".edit-menu").click(function () {
                $("#new-menu-Modal").modal('toggle');
                $("#new-menu").addClass('d-none');
                $("#edit-menu").removeClass('d-none');
                jDate = $(this).attr('data-jDate');
                gDate = $(this).attr('data-gDate');
                $('#jDate').val(jDate);
                $('#gDate').val(gDate);
                type = $(this).attr('data-type');
                let attribute;
                if (parseInt(type) === 1) {
                    attribute = 'data-lunchIds';
                    $("#dinner-radio").prop('checked', false);
                    $("#lunch-radio").prop('checked', true);
                    $("#dinner-label").removeClass('active');
                    $("#lunch-label").addClass('active');
                } else if (parseInt(type) === 2) {
                    attribute = 'data-dinnerIds';
                    $("#lunch-radio").prop('checked', false);
                    $("#dinner-radio").prop('checked', true);
                    $("#lunch-label").removeClass('active');
                    $("#dinner-label").addClass('active');
                }
                let registeredFoodList = $(this).attr(attribute);
                $("#selected-foods-list").children().remove();
                $(".foods").each(function () {
                    if (registeredFoodList.indexOf($(this).attr('data-food-id')) !== -1) {
                        let name = $(this).attr('data-food-name')
                        $(this).prop('checked', true)
                            .parent()
                            .addClass('active');
                        $("#selected-foods-list").append('<li class="text-right m-1">' + name + '</li>');
                    }
                });
            });

            $('#edit-menu').bind('click', function () {
                if (gDate.length === 0) {
                    toastr.error('لطفا تاریخ را انتخاب کنید.');
                } else if (parseInt(type) !== 1 && parseInt(type) !== 2) {
                    toastr.error('لطفا وعده غذایی را انتخاب کنید.');
                } else if (foodsList.length === 0) {
                    toastr.error('لطفا لیست غذاها را انتخاب کنید.');
                } else {
                    $(this).prop('disabled', true);
                    $(this).text('درحال ارسال اطلاعات...');
                    Axios.put('days-foods', {gDate, type, foodsList})
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                            $("#new-food-Modal").modal('toggle');
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

                        });
                }
            });

            $('.delete-menu').click(function () {
                let date = $(this).attr('data-date');
                toastr.warning('آیا از حذف این مورد مطمئن هستید؟' +
                    '<br>' +
                    '<button id="confirm-delete" class="btn btn-danger m-1">بله</button>' +
                    '<button class="btn btn-secondary clear m-1">خیر</button>');
                $("#confirm-delete").click(function () {
                    console.log('s.th clicked!', date);
                    Axios.delete('days-foods/' + date.replace('/', '-').replace('/', '-'))
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                            $("#menu-row-" + date.replace('/', '-').replace('/', '-')).remove();
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

            $("#list-foods").click(function () {
                $("#list-foods-Modal").modal('toggle');
            });

            $("#select-foods").click(function () {
                foodsList = [];
                $("#selected-foods-list > li").remove();
                $(".foods:checked").each(function () {
                    let id = $(this).val();
                    let name = $(this).attr('data-food-name');
                    foodsList.push({
                        id: id,
                        name: name
                    });
                    $("#selected-foods-list").append('<li class="text-right m-1">' + name + '</li>');
                });
                $("#list-foods-Modal").modal('toggle');
            });
        });
    </script>
@endpush

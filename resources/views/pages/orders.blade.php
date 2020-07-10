@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="row">
        @if(!is_null($dayFoods) && count($dayFoods) > 0)
            @foreach($dayFoods as $dayFood)
                <div class="col-12">
                    <div class="row border rounded m-1 d-flex align-items-center food-days-list">
                        <div class="col-2 text-center text-primary persian-numbers">
                            <h4 class="">{{$dayFood['dateArray']['weekday']}}</h4>
                            <h3>{{$dayFood['dateArray']['dayText']}}</h3>
                            <h5>{{$dayFood['dateArray']['monthText']}} {{$dayFood['dateArray']['yearText']}}</h5>
                        </div>
                        <div class="col-10 text-center ">
                            <div class="row d-flex align-items-center">
                                @php
                                    $flag=0;
                                @endphp
                                <div class="col-2 text-success">
                                    ناهار
                                </div>
                                @foreach($dayFood['lunchFoods'] as $item)
                                    @php
                                        if(!is_null($orders->where('days_food_id',$item->id)->first())){
                                            $flag=1;
                                        }
                                    @endphp
                                    <div class="col-2">
                                        <img id="image-{{$item->id}}"
                                             data-food-id="{{$item->id}}"
                                             data-food-type="1"
                                             data-date="{{$dayFood['date']}}"
                                             data-toggle="tooltip"
                                             data-html="true"
                                             class="m-1 food-item w-100 border rounded {{!is_null($orders->where('days_food_id',$item->id)->first()) ? 'active' : ''}}"
                                             src="{{url('storage/foods').'/'.$item->food->image}}"
                                             title="{{$item->food->name}}<br>{{$item->food->description}}">
                                        {{--                                        @if(!is_null($orders->where('days_food_id',$item->id)->first()))--}}
                                        {{--                                            <i class="fa fa-check text-success"></i>--}}
                                        {{--                                        @endif--}}
                                    </div>
                                @endforeach
                                <div class="col-2">
                                    <img
                                        data-food-id="-1"
                                        data-food-type="1"
                                        data-date="{{$dayFood['date']}}"
                                        data-toggle="tooltip"
                                        data-html="true"
                                        class="m-1 food-item w-100 border rounded {{$flag==0 ? 'active' : ''}}"
                                        src="{{asset('assets/images/im_fat.jpg')}}"
                                        title="امروز غذا میل ندارم">
                                    {{--                                    @if($flag==0)--}}
                                    {{--                                        <i class="fa fa-check text-success"></i>--}}
                                    {{--                                    @endif--}}
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="row d-flex align-items-center">
                                @php
                                    $flag=0;
                                @endphp
                                <div class="col-2 text-success">
                                    شام
                                </div>
                                @foreach($dayFood['dinnerFoods'] as $item)
                                    @php
                                        if(!is_null($orders->where('days_food_id',$item->id)->first())){
                                            $flag=1;
                                        }
                                    @endphp
                                    <div class="col-2">
                                        <img id="image-{{$item->id}}"
                                             data-food-id="{{$item->id}}"
                                             data-food-type="2"
                                             data-date="{{$dayFood['date']}}"
                                             data-toggle="tooltip"
                                             data-html="true"
                                             class="m-1 food-item w-100 border rounded {{!is_null($orders->where('days_food_id',$item->id)->first()) ? 'active' : ''}}"
                                             src="{{url('storage/foods').'/'.$item->food->image}}"
                                             title="{{$item->food->name}}<br>{{$item->food->description}}">
                                        {{--                                        @if(!is_null($orders->where('days_food_id',$item->id)->first()))--}}
                                        {{--                                            <i class="fa fa-check text-success"></i>--}}
                                        {{--                                        @endif--}}
                                    </div>
                                @endforeach
                                <div class="col-2">
                                    <img
                                        data-food-id="-1"
                                        data-food-type="2"
                                        data-date="{{$dayFood['date']}}"
                                        data-toggle="tooltip"
                                        data-html="true"
                                        class="m-1 food-item w-100 border rounded {{$flag==0 ? 'active' : ''}}"
                                        src="{{asset('assets/images/im_fat.jpg')}}"
                                        title="امروز غذا میل ندارم">
                                    {{--                                    @if($flag==0)--}}
                                    {{--                                        <i class="fa fa-check text-success"></i>--}}
                                    {{--                                    @endif--}}
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
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $(".food-item").click(function () {
                let foodId = $(this).attr('data-food-id');
                let date = $(this).attr('data-date');
                let type = $(this).attr('data-food-type');
                toastr.warning('آیا از این انتخاب مطمئن هستید؟' +
                    '<br>' +
                    '<button id="confirm-select-food" class="btn btn-danger m-1">بله</button>' +
                    '<button class="btn btn-secondary clear m-1">خیر</button>');
                $('#confirm-select-food').click(function () {
                    $("#loading").addClass('d-flex');
                    Axios.post('reservations', {foodId, date, type})
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        })
                        .catch(function (error) {
                            toastr.error('به علت اشکال داخلی انجام نشد.');
                            console.error(error);
                        })
                        .finally(function () {
                            $("#loading").removeClass('d-flex');
                        })
                });
            });
        });
    </script>
@endpush

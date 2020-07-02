@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="row">
        @if(!is_null($dayFoods) && count($dayFoods) > 0)
            @foreach($dayFoods as $dayFood)
                <div class="col-12">
                    <div class="row border rounded m-1">
                        <div class="col-2 text-center d-flex flex-column align-items-center persian-numbers">
                            <h4>{{$dayFood['dateArray']['weekday']}}</h4>
                            <h3>{{$dayFood['dateArray']['dayText']}}</h3>
                            <h5>{{$dayFood['dateArray']['monthText']}} {{$dayFood['dateArray']['yearText']}}</h5>
                        </div>
                        <div class="col-10 text-center">
                            <div class="row">
                                @php
                                    $flag=0;
                                @endphp
                                @foreach($dayFood['foods'] as $item)
                                    @php
                                        if(!is_null($orders->where('days_food_id',$item->id)->first())){
                                            $flag=1;
                                        }
                                    @endphp
                                    <div class="col-3">
                                        <img id="image-{{$item->id}}"
                                             data-food-id="{{$item->id}}"
                                             data-date="{{$dayFood['date']}}"
                                             class="m-1 food-item w-100 border rounded {{is_null($orders->where('days_food_id',$item->id)->first()) ? '' : 'border-danger'}}"
                                             src="{{url('storage/foods').'/'.$item->food->image}}"
                                             data-toggle="tooltip" data-html="true"
                                             title="{{$item->food->name}}<br>{{$item->food->description}}">
                                    </div>
                                @endforeach
                                <div class="col-3">
                                    <img data-food-id="-1" data-date="{{$dayFood['date']}}" class="m-1 food-item w-100 border rounded {{$flag==0 ? 'border-danger' : ''}}"
                                         src="{{asset('assets/images/im_fat.jpg')}}">
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
                toastr.warning('آیا از انتخاب این مطمئن هستید؟' +
                    '<br>' +
                    '<button id="confirm-select-food" class="btn btn-danger m-1">بله</button>' +
                    '<button class="btn btn-secondary clear m-1">خیر</button>');
                $('#confirm-select-food').click(function () {
                    Axios.post('reservations', {foodId, date})
                        .then(function (response) {
                            toastr.success('با موفقیت انجام شد.');
                        })
                        .catch(function (error) {
                            toastr.error('به علت اشکال داخلی انجام نشد.');
                            console.error(error);
                        })
                        .finally(function () {
                            setTimeout(function () {
                                window.location.reload();
                            }, 1000);
                        })
                });
            });
        });
    </script>
@endpush

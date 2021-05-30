@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="row">
        <div class="col-12 col-md-6">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-10 text-center font-weight-bold my-2">{{$question->title}}</div>
                <div class="col-2 text-center font-weight-bold my-2">{{$count}} رای</div>
                @foreach($question->answers as $answer)
                    <div class="col-10 text-center my-2">{{$answer->answer}}</div>
                    <div class="col-2 text-center my-2">{{count($answer->userAnswers)}} رای</div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.1/chart.min.js"
            integrity="sha512-dCMdvmRC8BuFAgdVMPrm5MJauIcozqGY8krxgbXyUhVTvR3vzH0x2qW2nB4jFdeymins2ZubDv7osK1roNBKjg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! $chartData['labels'] !!},
                datasets: [{
                    label: 'تعداد آرا',
                    data: {!! $chartData['data'] !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


    </script>
@endpush

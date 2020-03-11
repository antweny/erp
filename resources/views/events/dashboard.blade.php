@extends('layouts.templates.event')
@section('title','Store Dashboard')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <canvas id="genderCount" width="100%" height="30"></canvas>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')

    <script>
        //Show graph of individuals count by gender
        var ctx = document.getElementById('genderCount');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! $count_gdss->pluck('date') !!},
                datasets: [{
                    label: '# of GDSS Participants',
                    data:{!! $count_gdss->pluck('participants_count') !!},
                }]
            },

            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'GDSS Participants By Dates'
                },

            }
        });

    </script>

@endsection

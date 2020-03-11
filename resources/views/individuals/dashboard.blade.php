@extends('layouts.templates.individuals')
@section('title','Individuals Management')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="myChart" width="100%" height="80"></canvas>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('scripts')

    <script>

        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! $name_gender !!},
                datasets: [{
                    label: '# Individual By Gender',
                    data: {!! $count_gender !!},
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });




    </script>




@endsection

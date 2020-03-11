@extends('layouts.templates.individuals')
@section('title','Individuals Management')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="genderCount" width="100%" height="80"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <canvas id="ageGroup" width="100%" height="80"></canvas>
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
            type: 'doughnut',
            data: {
                labels: {!! $gender !!},
                datasets: [{
                    label: '# Individual By Gender',
                    data: {!! $count_gender !!},
                    backgroundColor: [
                        'pink',
                        'blue',
                        'gray',
                    ],
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

            }
        });

        //Show graph of individuals count by age group
        var ageGroup = document.getElementById('ageGroup');
        var myChart = new Chart(ageGroup, {
            type: 'bar',
            data: {
                labels: {!! $age_group !!},
                datasets: [{
                    label: '# Individual By Age',
                    data: {!! $count_age_group !!},
                    backgroundColor: [
                        'red',
                        'green',
                        'orange',
                        'purple',
                        'olive',
                        'maroon'
                    ],
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

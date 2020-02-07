@extends('layouts.admin')
@section('title','Events Management')
@section('content')
    <div class="row dashboard">
        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-header bg-warning">
                    Upcoming
                </div>
                <div class="card-body pt-0">
                    @foreach($events as $event)
                        @if($event->status == 'upcoming')
                            <li class="border-success">
                                <span class="title">{{ $event->name }}</span>
                                <span class="date">{{ get_day_month_and_year($event->start_date)}} - {{get_day_month_and_year($event->end_date)}}</span>
                                <span class="location">{{ $event->venue->name }}</span>
                            </li>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-header bg-primary">
                    Ongoing
                </div>
                <div class="card-body pt-0">
                    @foreach($events as $event)
                        @if($event->status == 'ongoing')
                            <li class="border-success">
                                <span class="title">{{ $event->name }}</span>
                                <span class="date">{{ get_day_month_and_year($event->start_date)}} - {{get_day_month_and_year($event->end_date)}}</span>
                                <span class="location">{{ $event->venue->name }}</span>
                            </li>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-header bg-success">
                   Completed
                </div>
                <div class="card-body">
                    @foreach($events as $event)
                        @if($event->status == 'completed')
                            <li class="border-success">
                                <span class="title">{{ $event->name }} ({{$event->participant_count}})</span>
                                <span class="date">{{ get_day_month_and_year($event->start_date)}} - {{get_day_month_and_year($event->end_date)}}</span>
                                <span class="location">{{ $event->venue->name }}</span>
                            </li>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    Upcoming GDSS
                </div>
                <div class="card-body">
                    @foreach($genders as $gender)
                        <li class="border-success">
                            <span class="title">{{ $gender->topic }}</span>
                            <span class="date">{{ get_day_month_and_year($gender->date)}}</span>
                            <span class="location">Facilitator: {{ $gender->facilitator  }}</span>
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>





@endsection

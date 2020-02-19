@extends('layouts.employee')
@section('title','Events list')
@section('content')

    <div class="card event">
        <div class="card-header">
            <div class="float-left">
                <h1 class="h4">Events List</h1>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{route('employee.events.create')}}" title="create"><i class="fa fa-plus"></i> New Event</a>
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center bg-blue">
                        <tr class="text-white">
                            <th scope="col">Event name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Coordinator</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Participants</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td class="text-left">{{ $event->name }}</td>
                            <td class="text-center">{{ $event->event_category->name }}</td>
                            <td class="text-center">{{ $event->employee->full_name  }}</td>
                            <td class="text-center">{{ get_day_month_and_year($event->start_date) }}</td>
                            <td class="text-center">{{  get_day_month_and_year($event->end_date) }}</td>
                            <td class="text-center">{!! $event->event_status !!}</td>
                            <td class="text-center"><a href="#" title="View Participants"></a></td>
                            <td class="text-center p-0">
                                <div class="btn btn-group">
                                    <a class="btn btn-primary btn-sm mr-2 " href="{{route('events.edit',$event->id)}}" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection

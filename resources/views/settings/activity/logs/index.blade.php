@extends('layouts.templates.settings')
@section('title','Activiy Logs')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">Activity Logs</h4>
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center">
                        <tr>
                            <th scope="col">Log name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Model</th>
                            <th scope="col">Performed By</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($activities as $activity)
                        <tr>
                            <td class="text-left">{{$activity->log_name}}</td>
                            <td class="text-center">{{$activity->description}}</td>
                            <td class="text-center">{{$activity->subject_type}}</td>
                            <td class="text-center">{{$activity->admin->name}}</td>
                            <td class="text-center">{{get_day_month_and_year($activity->created_at)}}</td>
                            <td class="text-center">{{get_day_month_and_year($activity->updated_at)}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a class="btn btn-danger btn-sm" href="#" title="Delete"><i class="fa fa-trash-alt"></i></a>
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

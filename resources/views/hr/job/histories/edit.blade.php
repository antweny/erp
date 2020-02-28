@extends('layouts.templates.hrm')
@section('title','Edit Job History')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Edit Job History</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('jobHistories.index')}}"><i class="fa fa-list"></i> View Job Histories</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($jobHistory, array('route' => array('jobHistories.update', $jobHistory->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                        @include('hr.job.histories._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

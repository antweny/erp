@extends('layouts.templates.hrm')
@section('title','Edit Job Type')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Update Job Type</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('jobTypes.index')}}"><i class="fa fa-list"></i> View Job Types</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($jobType, array('route' => array('jobTypes.update', $jobType->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                        @include('hr.job.types._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

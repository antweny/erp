@extends('layouts.templates.hrm')
@section('title','Edit designation')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Edit Designation</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('designations.index')}}"><i class="fa fa-list"></i> Designations list</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($designation, array('route' => array('designations.update', $designation->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                        @include('hr.designations._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

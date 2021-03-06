@extends('layouts.templates.individuals')
@section('title','Edit Education Level')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Edit {{$educationLevel->name}} certificate</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('educationLevels.index')}}"><i class="fa fa-list"></i> view Education Level</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($educationLevel, array('route' => array('educationLevels.update', $educationLevel->id), 'method' => 'PUT','autocomplete' => 'off')) }}
                        @include('education.levels._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

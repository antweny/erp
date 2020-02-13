@extends('layouts.individual')
@section('title','Edit Education Level')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Edit {{$educationLevel->name}} certificate</h4>
                            </div>
                            <div class="float-right">
                                @can('educationLevel-create')
                                    <a class="btn btn-primary " href="{{route('educationLevels.index')}}"><i class="fa fa-list"></i> List Education Level</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    {{ Form::model($educationLevel, array('route' => array('educationLevels.update', $educationLevel->id), 'method' => 'PUT','autocomplete' => 'off')) }}
                        @include('education.levels._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

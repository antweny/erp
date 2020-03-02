@extends('layouts.templates.individuals')
@section('title','Edit individual')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Edit Individual details</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('individuals.index')}}"><i class="fa fa-list"></i>view individuals</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($individual, array('route' => array('individuals.update', $individual->id), 'method' => 'PUT')) }}
                            @include('individuals._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

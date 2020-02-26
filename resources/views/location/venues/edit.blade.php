@extends('layouts.location')
@section('title','Edit venue')

@section('content')
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Edit venue details</h5>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('venues.index')}}"><i class="fa fa-list"></i> view venues</a>
                    </div>
                </div>

                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($venue, array('route' => array('venues.update', $venue->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                             @include('location.venues._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

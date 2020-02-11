@extends('layouts.location')
@section('title','Edit venue')

@section('content')
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Edit {{$venue->name}} venue</h4>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary " href="{{route('venues.index')}}"><i class="fa fa-list"></i> List venues</a>
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    {{ Form::model($venue, array('route' => array('venues.update', $venue->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                             @include('location.venues._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

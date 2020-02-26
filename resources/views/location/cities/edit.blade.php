@extends('layouts.location')
@section('title','Edit city')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Edit city details </h5>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('cities.index')}}"><i class="fa fa-list"></i> view cities</a>
                    </div>
                </div>

                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($city, array('route' => array('cities.update', $city->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                        @include('location.cities._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

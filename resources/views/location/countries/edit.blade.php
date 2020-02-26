@extends('layouts.location')
@section('title','Edit country')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Edit country details</h5>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('countries.index')}}"><i class="fa fa-list"></i> view countries</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($country, array('route' => array('countries.update', $country->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                        @include('location.countries._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

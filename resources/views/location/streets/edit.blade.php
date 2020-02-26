@extends('layouts.location')
@section('title','Edit street/village')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Edit street/village details</h5>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('streets.index')}}"><i class="fa fa-list"></i> view streets</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($street, array('route' => array('streets.update', $street->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                        @include('location.streets._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

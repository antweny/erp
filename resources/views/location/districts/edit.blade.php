@extends('layouts.location')
@section('title','Edit district')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Edit district details</h5>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('districts.index')}}"><i class="fa fa-list"></i> view districts</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($district, array('route' => array('districts.update', $district->id), 'method' => 'PUT')) }}
                        @include('location.districts._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.location')
@section('title','Edit ward')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Edit ward details</h5>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('wards.index')}}"><i class="fa fa-list"></i> view wards</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($ward, array('route' => array('wards.update', $ward->id), 'method' => 'PUT')) }}
                        @include('location.wards._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.location')
@section('title','Edit ward')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Edit {{$ward->name}} ward</h4>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-flat btn-info text-white " href="{{route('wards.index')}}"><i class="fa fa-list"></i> List wards</a>
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    {{ Form::model($ward, array('route' => array('wards.update', $ward->id), 'method' => 'PUT')) }}
                        @include('location.wards._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

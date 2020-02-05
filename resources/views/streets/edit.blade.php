@extends('layouts.location')
@section('title','Edit street')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Edit {{$street->name}} street</h4>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-flat btn-info text-white " href="{{route('streets.index')}}"><i class="fa fa-list"></i> List streets</a>
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    {{ Form::model($street, array('route' => array('streets.update', $street), 'method' => 'PUT','autocomplete'=>'off')) }}
                        @include('streets._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

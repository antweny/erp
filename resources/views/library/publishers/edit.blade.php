@extends('layouts.templates.library')
@section('title','Edit publisher')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Edit publisher details</h5>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('publishers.index')}}"><i class="fa fa-list"></i> view publishers</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($publisher, array('route' => array('publishers.update', $publisher->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                    @include('library.publishers._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

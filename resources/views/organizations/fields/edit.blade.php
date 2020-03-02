@extends('layouts.templates.organizations')
@section('title','Edit field')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Edit {{$field->name}} field</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('fields.index')}}"><i class="fa fa-list"></i>View Fields List</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($field, array('route' => array('fields.update', $field->id), 'method' => 'PUT')) }}
                        @include('organizations.fields._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

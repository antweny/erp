@extends('layouts.organization')
@section('title','Edit field')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Edit {{$field->name}} field</h4>
                            </div>
                            <div class="float-right">
                                @can('field-create')
                                    <a class="btn btn-primary " href="{{route('fields.index')}}"><i class="fa fa-list"></i> List fields</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    {{ Form::model($field, array('route' => array('fields.update', $field->id), 'method' => 'PUT')) }}
                        @include('organizations.fields._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

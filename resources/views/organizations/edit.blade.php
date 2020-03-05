@extends('layouts.templates.organizations')
@section('title','Edit organization')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Edit Organization</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('organizations.index')}}"><i class="fa fa-list"></i> List organizations</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($organization, array('route' => array('organizations.update', $organization->id), 'method' => 'PUT')) }}
                        @csrf
                        @include('organizations._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

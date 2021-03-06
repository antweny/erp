@extends('layouts.templates.event')
@section('title','Edit Participant Role')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Edit {{$participantRole->name}} participantRole</h4>
                    </div>
                    <div class="float-right">
                        @can('participantRole-create')
                            <a class="btn btn-warning text-white" href="{{route('participantRoles.index')}}"><i class="fa fa-list"></i> view Participant Roles</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($participantRole, array('route' => array('participantRoles.update', $participantRole->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                        @include('participants.roles._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

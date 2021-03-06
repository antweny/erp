@extends('layouts.templates.individuals')
@section('title','Edit group')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-group">Edit {{$group->name}} group</h4>
                    </div>
                    <div class="float-right">
                        @can('group-create')
                            <a class="btn btn-primary " href="{{route('groups.index')}}"><i class="fa fa-list"></i> View Groups</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($group, array('route' => array('groups.update', $group->id), 'method' => 'PUT','autocomplete' => 'off')) }}
                        @include('individuals.groups._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection

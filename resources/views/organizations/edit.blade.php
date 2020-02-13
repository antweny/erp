@extends('layouts.organization')
@section('title','Edit organization')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Edit <strong>{{$organization->name}}</strong> Organization</h4>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary" href="{{route('organizations.index')}}"><i class="fa fa-list"></i> List organizations</a>
                            </div>
                        </div>
                    </div>
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

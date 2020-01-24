@extends('layouts.admin')
@section('title','Edit pillar')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Edit {{$pillar->name}} pillar</h4>
                            </div>
                            <div class="float-right">
                                @can('pillar-create')
                                    <a class="btn btn-primary " href="{{route('pillars.index')}}"><i class="fa fa-list"></i> List pillars</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    {{ Form::model($pillar, array('route' => array('pillars.update', $pillar), 'method' => 'PUT')) }}
                        @include('pillars._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.templates.organizations')
@section('title','Edit sector')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Edit {{$sector->name}} sector</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('sectors.index')}}"><i class="fa fa-list"></i> View Sectors</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($sector, array('route' => array('sectors.update', $sector->id), 'method' => 'PUT')) }}
                        @include('organizations.sectors._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

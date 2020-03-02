@extends('layouts.templates.individuals')
@section('title','Update position')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h1 class="h4">Update Position</h1>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('positions.index')}}" title="create"><i class="fa fa-list mr-1"></i> view positions</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($position, array('route' => array('positions.update', $position->id), 'method' => 'PUT')) }}
                            @include('individuals.positions._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>


@endsection


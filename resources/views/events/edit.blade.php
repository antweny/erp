@extends('layouts.admin')
@section('title','Update event')
@section('content')


    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h1 class="h4">Update Event</h1>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{route('events.index')}}" title="create"><i class="fa fa-list mr-1"></i> view events</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($event, array('route' => array('events.update', $event->id), 'method' => 'PUT')) }}
                            @include('events._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>


@endsection


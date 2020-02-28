@extends('layouts.templates.event')
@section('title','Update event')
@section('content')


    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Update Event</h5>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('events.index')}}" title="create"><i class="fa fa-list mr-1"></i> view events</a>
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


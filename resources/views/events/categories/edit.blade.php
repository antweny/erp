@extends('layouts.templates.event')
@section('title','Edit Event Category')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5 class="header-title">Edit Event Category</h5>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('eventCategories.index')}}" title="create"><i class="fa fa-list"></i> view event categories</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($eventCategory, array('route' => array('eventCategories.update', $eventCategory->id), 'method' => 'PUT','autocomplete' => 'off')) }}
                        @include('events.categories._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

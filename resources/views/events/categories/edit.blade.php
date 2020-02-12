@extends('layouts.event')
@section('title','Edit Event Category')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Edit {{$eventCategory->name}} eventCategory</h4>
                            </div>
                            <div class="float-right">
                                @can('eventCategory-create')
                                    <a class="btn btn-primary " href="{{route('eventCategories.index')}}"><i class="fa fa-list"></i> Event Categories</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    {{ Form::model($eventCategory, array('route' => array('eventCategories.update', $eventCategory->id), 'method' => 'PUT','autocomplete' => 'off')) }}
                        @include('events.categories._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

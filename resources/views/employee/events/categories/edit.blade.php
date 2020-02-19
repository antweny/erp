@extends('layouts.employee')
@section('title','Edit Event Category')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Edit {{$eventCategory->name}} Event Category</h4>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary " href="{{route('employee.eventCategories.index')}}"><i class="fa fa-list"></i> Event Categories</a>
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    {{ Form::model($eventCategory, array('route' => array('employee.eventCategories.update', $eventCategory->id), 'method' => 'PUT','autocomplete' => 'off')) }}
                        @include('employee.events.categories._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

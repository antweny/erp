@extends('layouts.templates.individuals')
@section('title','Edit title')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Edit {{$title->name}} title</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('titles.index')}}"><i class="fa fa-list"></i> View Titles List</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($title, array('route' => array('titles.update', $title->id), 'method' => 'PUT','autocomplete' => 'off')) }}
                        @include('individuals.titles._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

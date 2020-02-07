@extends('layouts.title')
@section('title','Edit title')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Edit {{$title->name}} title</h4>
                            </div>
                            <div class="float-right">
                                @can('title-create')
                                    <a class="btn btn-primary " href="{{route('titles.index')}}"><i class="fa fa-list"></i> List titles</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    {{ Form::model($title, array('route' => array('titles.update', $title), 'method' => 'PUT','autocomplete' => 'off')) }}
                        @include('titles._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

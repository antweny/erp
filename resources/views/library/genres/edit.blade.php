@extends('layouts.templates.library')

@section('title','Edit Genre')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Edit Genre</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('genres.index')}}" ><i class="fa fa-list"></i> View Shelves</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($genre, array('route' => array('genres.update', $genre->id), 'method' => 'PUT')) }}
                        @include('library.genres._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.templates.library')
@section('title','Edit author')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Edit author details</h5>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('authors.index')}}"><i class="fa fa-list"></i> view authors</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($author, array('route' => array('authors.update', $author->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                            @include('library.authors._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

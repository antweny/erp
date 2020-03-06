@extends('layouts.templates.library')

@section('title','Edit Shelf')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Edit Shelf</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('shelves.index')}}" ><i class="fa fa-list"></i> View Shelves</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($shelf, array('route' => array('shelves.update', $shelf->id), 'method' => 'PUT')) }}
                        @include('library.shelves._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

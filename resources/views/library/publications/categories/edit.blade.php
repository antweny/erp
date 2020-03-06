@extends('layouts.templates.library')

@section('title','Edit publication category')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Edit publication category</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('publicationCategories.index')}}" ><i class="fa fa-list"></i> View Organization Categories</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($publicationCategory, array('route' => array('publicationCategories.update', $publicationCategory->id), 'method' => 'PUT')) }}
                        @include('library.publications.categories._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

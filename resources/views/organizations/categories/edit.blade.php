@extends('layouts.templates.organizations')

@section('title','Edit organisation category')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Edit organization category</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('categories.index')}}" ><i class="fa fa-list"></i> View Organization Categories</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($category, array('route' => array('categories.update', $category->id), 'method' => 'PUT')) }}
                            @include('Organizations.categories._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

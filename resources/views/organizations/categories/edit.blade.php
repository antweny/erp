@extends('layouts.organization')

@section('title','Edit organisation category')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit {{$category->name}} organization category</h4>
                    @include('alerts._flash')
                    {{ Form::model($category, array('route' => array('categories.update', $category), 'method' => 'PUT')) }}
                            @include('Organizations.categories._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

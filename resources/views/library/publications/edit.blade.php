@extends('layouts.templates.library')
@section('title','Update publication')
@section('content')


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Update Publication</h5>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('publications.index')}}" title="create"><i class="fa fa-list mr-1"></i> view publications</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($publication, array('route' => array('publications.update', $publication->id), 'method' => 'PUT')) }}
                        @include('library.publications._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>


@endsection


@extends('layouts.admin')
@section('title','Edit designation')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Edit Designation</h4>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-flat btn-info text-white " href="{{route('designations.index')}}"><i class="fa fa-list"></i> Designations list</a>
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    {{ Form::model($designation, array('route' => array('designations.update', $designation->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                        @include('hr.designations._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

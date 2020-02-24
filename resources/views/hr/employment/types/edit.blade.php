@extends('layouts.admin')
@section('title','Edit employmentType')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Edit Employment Type</h4>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-flat btn-info text-white " href="{{route('employmentTypes.index')}}"><i class="fa fa-list"></i> Employment Types list</a>
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    {{ Form::model($employmentType, array('route' => array('employmentTypes.update', $employmentType->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                        @include('hr.employment.types._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

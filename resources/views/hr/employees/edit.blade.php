@extends('layouts.hr')
@section('title','Update Employee')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Update Employee</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{route('employee.index')}}" title="create"><i class="fa fa-list mr-1"></i>Employee List</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($employee, array('route' => array('employee.update', $employee), 'method' => 'PUT','autocomplete'=>'off')) }}

                        @include('employees._form',['buttonText'=>'Update'])

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

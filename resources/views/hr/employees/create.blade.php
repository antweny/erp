@extends('layouts.admin')
@section('title','New Employee')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">New Employee</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{route('employee.index')}}" title="create"><i class="fa fa-list mr-1"></i>Employee List</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    <form method="POST" action="{{route('employee.store')}}" class="form" autocomplete="off">
                        @include('hr.employees._form',['buttonText'=>'Save Record'])
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

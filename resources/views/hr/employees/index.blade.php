@extends('layouts.hr')
@section('title','Employee List')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Employee List</h4>
                    </div>
                    <div class="float-right">
                        @can('item-create')
                            <a class="btn btn-primary" href="{{route('employee.create')}}"><i class="fa fa-plus"></i> New Employee</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="row">
                @foreach($employees as $employee)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                        bvmvbmbvmnbv
                            </div>
                            <div class="col-md-8 col-sm-12 emp-details ">
                                <div class="h4 mt-2">{{$employee->full_name}}
                                    @can('employee-update')
                                        <a class="float-right btn btn-outline-secondary btn-sm" href="{{route('employee.edit',$employee)}}"  ><i class="fa fa-pencil-alt"></i> edit</a>
                                    @endcan
                                </div>
                                <div class="h5">{{$employee->full_name}}</div>
                                <div class="h6"><strong>Department: </strong></strong>{{$employee->department->name}}</div>
                                <div><strong>Email:</strong> {{$employee->email}}</div>
                                <div><strong>Mobile:</strong> {{$employee->mobile}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

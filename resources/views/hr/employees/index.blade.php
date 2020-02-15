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
                        @if(checkPermission('employee-create'))
                            <a class="btn btn-primary" href="{{route('employee.create')}}"><i class="fa fa-plus"></i> New Employee</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center bg-blue">
                        <tr class="text-white">
                            <th scope="col">Emp. No</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Position</th>
                            <th scope="col">Department</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td class="text-center">{{ $employee->employee_no}}</td>
                            <td class="text-left">{{ $employee->full_name}}</td>
                            <td class="text-center">{{ $employee->email }}</td>
                            <td class="text-center">{{$employee->mobile}}</td>
                            <td class="text-center">{{$employee->mobile}}</td>
                            <td class="text-center">{{$employee->department->name}}</td>
                            <td class="text-center p-0">
                                <div class="btn btn-group">
                                    @if(checkPermission('employee-update'))
                                        <a class="float-right btn btn-outline-secondary btn-sm" href="{{route('employee.edit',$employee->id)}}"  >
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>

                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

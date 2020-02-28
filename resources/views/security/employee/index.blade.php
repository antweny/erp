@extends('layouts.templates.security')
@section('title','List of Employee Credentials')
@section('content')

    <div class="ca card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">List of Employee Credentials</h4>
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center">
                    <tr>
                        <th scope="col">Employee No.</th>
                        <th scope="col">Employee Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td class="text-center">{{$employee->employee_no}}</td>
                            <td class="text-center">{{$employee->full_name}}</td>
                            <td class="text-center">{{$employee->email}}</td>
                            <td class="text-center p-0">
                                <div class="btn btn-group">
                                    <a class="btn btn-outline-secondary btn-sm" href="{{route('employee.resetPasswordForm',$employee)}}" title="Reset Password"><i class="fa fa-key"></i></a>
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


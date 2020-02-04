@extends('layouts.master')

@section('body')

    <div class="row">
        <div class="col-md-2">
            <div class="inside-menu card">
                <div class="card-body">
                    <ul class="list-group list-group-flush p-0">

                        <li class="list-group-item">
                            @can('department-read')
                                <a href="{{route('departments.index')}}">
                                    <i class="fa fa-building"></i>
                                    Departments
                                </a>
                            @endcan
                        </li>

                        <li class="list-group-item">
                            @can('employee-read')
                                <a href="{{route('employee.index')}}">
                                    <i class="fa fa-user"></i>
                                    Employees
                                </a>
                            @endcan
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            @yield('content')
        </div>
    </div>

@endsection

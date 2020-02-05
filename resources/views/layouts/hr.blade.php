@extends('layouts.master')

@section('body')

    <div class="row">
        <div class="col-md-2">
            <div class="inside-menu card">
                <div class="card-body">
                    <ul class="list-group list-group-flush p-0">

                        @can('department-read')
                            <a class="list-group-item" href="{{route('departments.index')}}">
                                <i class="fa fa-building"></i>
                                Departments
                            </a>
                        @endcan

                        @can('employee-read')
                            <a class="list-group-item" href="{{route('employee.index')}}">
                                <i class="fa fa-user"></i>
                                Employees
                            </a>
                        @endcan

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            @yield('content')
        </div>
    </div>

@endsection

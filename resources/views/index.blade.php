@extends('layouts.public')
@section('title','TGNP Enterprise Resource Planning (ERP)')
@section('content')

    <div class="front text-center row">

        <div class="col-md-4 bg-">
            <a href="#">
                <img src="{{asset('img/public.png')}}">
                <div><span>admin portal</span></div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{route('employee.login')}}">
                <img src="{{asset('img/employee.png')}}">
                <div> <span>Empolyee Portal</span></div>
            </a>
        </div>
        <div class="col-md-4 ">
            <a href="{{route('admin.login')}}">
                <img src="{{asset('img/admin.png')}}">
                <div><span>Admin Portal</span></div>
            </a>
        </div>

    </div>

@endsection






@extends('layouts.admin')

@section('title','Admin Dashboard')

@section('content')
    <div class="row dash-menu">
        <div class="col-md-2">
            <li class="bg-green">
                <a href="{{route('hrm')}}" class="text-white">
                    <i class="fa fa-user-cog"></i>
                    <span>Human Resource Management</span>
                </a>
            </li>
        </div>

        <div class="col-md-2">
            <li class="bg-orange">
                <a href="#" class="text-white">
                    <i class="fa fa-city"></i>
                    <span>Organizations Management</span>
                </a>
            </li>
        </div>

        <div class="col-md-2">
            <li class="bg-black">
                <a href="#" class="text-white">
                    <i class="fa fa-users"></i>
                    <span>People Management</span>
                </a>
            </li>

        </div>

        <div class="col-md-2">
            <li class="bg-cyna">
                <a href="{{route('event')}}" class="text-white">
                    <i class="fa fa-calendar"></i>
                    <span>Events Management</span>
                </a>
            </li>
        </div>

        <div class="col-md-2">
            <li class="bg-pink">
                <a href="{{route('store')}}" class="text-white">
                    <i class="fa fa-store"></i>
                    <span> Store Management</span>
                </a>
            </li>
        </div>

        <div class="col-md-2">
            <li class="bg-danger">
                <a href="{{route('security')}}" class="text-white">
                    <i class="fa fa-lock"></i>
                    <span>System Security</span>
                </a>
            </li>
        </div>

        <div class="col-md-2">
            <li class="bg-danger">
                <a href="{{route('settings')}}" class="text-white">
                    <i class="fa fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
        </div>

        <div class="col-md-2">
            <li class="bg-primary">
                <a href="{{route('location')}}" class="text-white">
                    <i class="fa fa-map-marked-alt"></i>
                    <span>Location Management</span>
                </a>
            </li>
        </div>

    </div>
@endsection

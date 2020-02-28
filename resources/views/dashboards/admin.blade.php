@extends('layouts.admin')
@section('title','Admin Dashboard')
@section('content')
    <div class="row sub-menu">

        <div class="col-sm-4 col-md-3">
            <a href="{{route('hrm')}}" class="sub-menu-link  pt-4">
                <div>
                    <i class="fa fa-user-cog"></i>
                    <span>Human Resource Management</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-3">
            <a href="#" class="sub-menu-link  pt-4">
                <div>
                    <i class="fa fa-city"></i>
                    <span>Organizations Management</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-3">
            <a href="#" class="sub-menu-link  pt-4">
                <div>
                    <i class="fa fa-users"></i>
                    <span>Contacts Management</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-3">
            <a href="{{route('event')}}" class="sub-menu-link  pt-4">
                <div>
                    <i class="fa fa-calendar"></i>
                    <span>Events Management</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-3">
            <a href="{{route('store')}}" class="sub-menu-link  pt-4">
                <div>
                    <i class="fa fa-store"></i>
                    <span> Store Management</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-3">
            <a href="{{route('location')}}" class="sub-menu-link  pt-4">
                <div>
                    <i class="fa fa-map-marked-alt"></i>
                    <span>Location Management</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-3">
            <a href="{{route('security')}}" class="sub-menu-link  pt-4">
                <div>
                    <i class="fa fa-lock"></i>
                    <span>System Security</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-3">
            <a href="{{route('settings')}}" class="sub-menu-link  pt-4">
                <div>
                    <i class="fa fa-cog"></i>
                    <span>Settings</span>
                </div>
            </a>
        </div>



    </div>




@endsection

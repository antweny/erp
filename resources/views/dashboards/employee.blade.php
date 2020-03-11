@extends('layouts.admin')
@section('title','Main Dashboard')
@section('content')
    <div class="row sub-menu">

        <div class="col-sm-4 col-md-2">
            <a href="{{route('hrm')}}" class="sub-menu-link bg-pink">
                <div>
                    <i class="fa fa-user-cog"></i>
                    <span>Human Resource Management</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-2">
            <a href="{{route('organization')}}" class="sub-menu-link bg-orange">
                <div>
                    <i class="fa fa-city"></i>
                    <span>Organizations Management</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-2">
            <a href="{{route('individual')}}" class="sub-menu-link bg-purple ">
                <div>
                    <i class="fa fa-users"></i>
                    <span>Individuals Management</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-2">
            <a href="{{route('event')}}" class="sub-menu-link  bg-green">
                <div>
                    <i class="fa fa-calendar"></i>
                    <span>Events Management</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-2">
            <a href="{{route('store')}}" class="sub-menu-link bg-black">
                <div>
                    <i class="fa fa-store"></i>
                    <span> Store Management</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-2">
            <a href="{{route('location')}}" class="sub-menu-link bg-gray ">
                <div>
                    <i class="fa fa-map-marked-alt"></i>
                    <span>Location Management</span>
                </div>
            </a>
        </div>

        @role('superAdmin')
        <div class="col-sm-4 col-md-2">
            <a href="{{route('security')}}" class="sub-menu-link bg-red">
                <div>
                    <i class="fa fa-lock"></i>
                    <span>System Security</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-2">
            <a href="{{route('settings')}}" class="sub-menu-link bg-maroon">
                <div>
                    <i class="fa fa-cog"></i>
                    <span>Settings</span>
                </div>
            </a>
        </div>
        @endrole


        <div class="col-sm-4 col-md-2">
            <a href="{{route('supports')}}" class="sub-menu-link bg-chocolate">
                <div>
                    <i class="fa fa-headset"></i>
                    <span>Support</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-2">
            <a href="{{route('library')}}" class="text-dark sub-menu-link bg-yellow">
                <div>
                    <i class="fa fa-book-reader"></i>
                    <span>Library</span>
                </div>
            </a>
        </div>

        <div class="col-sm-4 col-md-2">
            <a href="{{route('library')}}" class="sub-menu-link bg-slateblue">
                <div>
                    <i class="fa fa-project-diagram"></i>
                    <span>Projects Management</span>
                </div>
            </a>
        </div>


        <div class="col-sm-4 col-md-2">
            <a href="{{route('library')}}" class="sub-menu-link bg-olive">
                <div>
                    <i class="fa fa-book-reader"></i>
                    <span>Monitoring & Evaluation</span>
                </div>
            </a>
        </div>


    </div>

@endsection

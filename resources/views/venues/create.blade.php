@extends('layouts.location')

@section('title','New Venue')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">New Venue</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-flat bg-blue text-white " href="{{route('venues.index')}}"><i class="fa fa-list"></i> view venues</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    <form method="POST" action="{{route('venues.store')}}" class="form" autocomplete="off">
                        @include('venues._form',['buttonText'=>'save'])
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.templates.individuals')
@section('title','New Individual')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">New Individual</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('individuals.index')}}"><i class="fa fa-list"></i>view individuals</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    <form method="POST" action="{{route('individuals.store')}}" class="form" autocomplete="off" >
                        @include('individuals._form',['buttonText'=>'save'])
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

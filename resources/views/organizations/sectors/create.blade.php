@extends('layouts.organization')

@section('title','New sector')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">New Country</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-flat btn-info text-white " href="{{route('sectors.index')}}"><i class="fa fa-list"></i> view sectors</a>
                    </div>
                </div>

                <div class="card-body">
                    @include('alerts._flash')
                    <form method="POST" action="{{route('sectors.store')}}" class="form" autocomplete="off">
                        @include('organizations.sectors._form',['buttonText'=>'save new'])
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection

@extends('layouts.admin')

@section('title','New pillar')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">New Country</h4>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-flat btn-info text-white " href="{{route('pillars.index')}}"><i class="fa fa-list"></i> view pillars</a>
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    <form method="POST" action="{{route('pillars.store')}}" class="form">
                        @include('pillars._form',['buttonText'=>'save new'])
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

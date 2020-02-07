@extends('layouts.admin')

@section('title','New field')

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
                                <a class="btn btn-flat btn-info text-white " href="{{route('fields.index')}}"><i class="fa fa-list"></i> view fields</a>
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    <form method="POST" action="{{route('fields.store')}}" class="form">
                        @include('organizations.fields._form',['buttonText'=>'save new'])
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

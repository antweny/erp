@extends('layouts.organization')

@section('title','New Organizations')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">New Organization</h4>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary " href="{{route('organizations.index')}}"><i class="fa fa-list"></i> list organizations</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('alerts._flash')

                    <form method="POST" action="{{route('organizations.store')}}" class="form" autocomplete="off">
                        @csrf
                        @include('organizations._form',['buttonText'=>'Save Organization'])
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

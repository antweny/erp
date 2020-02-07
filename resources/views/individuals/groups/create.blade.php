@extends('layouts.individual')

@section('title','New group')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-group">New Group</h4>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-primary " href="{{route('groups.index')}}"><i class="fa fa-list"></i> view groups</a>
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    <form method="POST" action="{{route('groups.store')}}" class="form">
                        @include('individuals.groups._form',['buttonText'=>'save new'])
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

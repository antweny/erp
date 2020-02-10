@extends('layouts.event')
@section('title','Update event participants')
@section('content')


    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h1 class="h4">Update Event Participants</h1>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{route('participants.index')}}" title="create"><i class="fa fa-list mr-1"></i> view participants</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    <form method="POST" action="{{route('participants.update',$participant->id)}}" class="form" autocomplete="off">
                        @method('PUT')
                        @include('participants._form',['buttonText'=>'Update'])
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


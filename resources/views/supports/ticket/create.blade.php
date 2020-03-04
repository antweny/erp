@extends('layouts.templates.support')
@section('title','Create Ticket')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Create Ticket</h5>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('tickets.index')}}" title="create"><i class="fa fa-list mr-1"></i>view tickets</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    <form method="POST" action="{{route('tickets.store')}}" class="form" autocomplete="off">
                        @include('supports.ticket._form',['buttonText'=>'Submit Ticket'])
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

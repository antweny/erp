@extends('layouts.templates.support')
@section('title','Update Ticket')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Update Ticket</h5>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('tickets.index')}}" title="create"><i class="fa fa-list mr-1"></i> view tickets</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($ticket, array('route' => array('tickets.update', $ticket->id), 'method' => 'PUT')) }}
                        @include('supports.ticket._form',['buttonText'=>'Update Ticket'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection


@extends('layouts.templates.support')
@section('title','Edit Ticket Category')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Update Ticket Category</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('ticketCategories.index')}}"><i class="fa fa-list"></i> View Job Types</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($ticketCategory, array('route' => array('ticketCategories.update', $ticketCategory->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                        @include('supports.ticket.categories._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

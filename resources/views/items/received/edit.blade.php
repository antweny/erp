@extends('layouts.admin')
@section('title','Update Item Received')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h1 class="h4">Update Item Received</h1>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-info btn-sm text-white" href="{{route('itemReceived.index')}}" title="create"><i class="fa fa-list mr-1"></i> item received</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($itemReceived, array('route' => array('itemReceived.update', $itemReceived), 'method' => 'PUT')) }}
                                @include('items.received._form',['buttonText'=>'Save Record'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>


@endsection


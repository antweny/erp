@extends('layouts.admin')
@section('title','Update Gender Series Topic')
@section('content')


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h1 class="h4">Update Gender Series Topic</h1>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{route('genderSeries.index')}}" title="create"><i class="fa fa-list mr-1"></i> Back to List</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($genderSeries, array('route' => array('genderSeries.update', $genderSeries->id), 'method' => 'PUT')) }}
                            @include('events.genderSeries._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>


@endsection


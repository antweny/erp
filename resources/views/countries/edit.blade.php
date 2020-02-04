@extends('layouts.location')
@section('title','Edit country')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row hd">
                        <div class="col-md-12">
                            <div class="float-left">
                                <h4 class="header-title">Edit {{$country->name}} country</h4>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-flat btn-info text-white " href="{{route('countries.index')}}"><i class="fa fa-list"></i> List countries</a>
                            </div>
                        </div>
                    </div>
                    @include('alerts._flash')
                    {{ Form::model($country, array('route' => array('countries.update', $country), 'method' => 'PUT')) }}
                        @include('countries._form',['buttonText'=>'update'])
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

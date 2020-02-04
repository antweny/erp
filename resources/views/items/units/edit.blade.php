@extends('layouts.admin')
@section('title','Update Item Unit')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Update <strong>{{$itemUnit->name}}</strong> Unit</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary " href="{{route('itemUnits.index')}}"><i class="fa fa-list"></i> Item Units</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($itemUnit, array('route' => array('itemUnits.update', $itemUnit), 'method' => 'PUT')) }}
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-form-label">Item Unit Name <span class="star">*</span></label>
                                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{$itemUnit->name}}" placeholder="Ex. Stationary, IT" required/>
                                @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label">Descriptions</label>
                                <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{$itemUnit->desc}}</textarea>
                                @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-6 float-left">
                                <a class="btn btn-outline-secondary" href="{{route('itemUnits.index')}}">Cancel</a>
                            </div>
                            <div class="col-md-6">
                                <div class="float-right">
                                    <input type="submit" class="btn btn-primary" value="update"/>
                                </div>
                            </div>
                        </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

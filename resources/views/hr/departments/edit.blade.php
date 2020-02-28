@extends('layouts.templates.hrm')
@section('title','Update Department')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Update <strong>{{$department->name}}</strong> department</h5>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white " href="{{route('departments.index')}}"><i class="fa fa-list"></i> View Departments</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($department, array('route' => array('departments.update', $department->id), 'method' => 'PUT')) }}
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-form-label">Department Name <span class="star">*</span></label>
                                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{$department->name}}" placeholder="Ex. Stationary, IT" required/>
                                @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label">Descriptions</label>
                                <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{$department->desc}}</textarea>
                                @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-6 float-left">
                                <a class="btn btn-dark" href="{{route('departments.index')}}">Cancel</a>
                            </div>
                            <div class="col-md-6">
                                <div class="float-right">
                                    <input type="submit" class="btn btn-success" value="update"/>
                                </div>
                            </div>
                        </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection

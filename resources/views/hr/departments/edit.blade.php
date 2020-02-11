@extends('layouts.hr')
@section('title','Update Department')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Update <strong>{{$department->name}}</strong> department</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary " href="{{route('departments.index')}}"><i class="fa fa-list"></i> Departments</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($department, array('route' => array('departments.update', $department->id), 'method' => 'PUT')) }}
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label class="col-form-label">Department Name <span class="star">*</span></label>
                                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{$department->name}}" placeholder="Ex. Stationary, IT" required/>
                                @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Sort Number</label>
                                <input type="number" name="sort" id="sort" class="form-control {{ $errors->has('sort') ? ' is-invalid' : '' }} " value="{{$department->sort}}" placeholder="0, 1, 2" />
                                @if ($errors->has('sort'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('sort') }}</strong></span>@endif
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
                                <a class="btn btn-outline-secondary" href="{{route('departments.index')}}">Cancel</a>
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

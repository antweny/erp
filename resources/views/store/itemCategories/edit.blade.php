@extends('layouts.templates.store')
@section('title','Update Item Category')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Update <strong>{{$itemCategory->name}}</strong> Category</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('itemCategories.index')}}"><i class="fa fa-list"></i> view Item Categories</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($itemCategory, array('route' => array('itemCategories.update', $itemCategory->id), 'method' => 'PUT')) }}
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label class="col-form-label">Item Category Name <span class="star">*</span></label>
                                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{$itemCategory->name}}" placeholder="Ex. Stationary, IT" required/>
                                @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Sort Number</label>
                                <input type="number" name="sort" id="sort" class="form-control {{ $errors->has('sort') ? ' is-invalid' : '' }} " value="{{$itemCategory->sort}}" placeholder="0, 1, 2" />
                                @if ($errors->has('sort'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('sort') }}</strong></span>@endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label">Descriptions</label>
                                <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{$itemCategory->desc}}</textarea>
                                @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-6 float-left">
                                <a class="btn btn-dark" href="{{route('itemCategories.index')}}">Cancel</a>
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

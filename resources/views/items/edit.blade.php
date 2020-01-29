@extends('layouts.admin')
@section('title','Update Item')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Update <strong>{{$item->name}}</strong> item</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary " href="{{route('items.index')}}"><i class="fa fa-list"></i> items</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($item, array('route' => array('items.update', $item), 'method' => 'PUT','autocomplete'=>'off')) }}
                        @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="col-form-label">Item Name <span class="star">*</span></label>
                            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{$item->name}}" placeholder="Ex. Ream Paper, Staple Pins" required/>
                            @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="col-form-label">Category <span class="star">*</span></label>
                            <select name="item_category_id" class="form-control">
                                <option value="">Select Category...</option>
                                @foreach($itemCategories as $itemCategory)
                                    <option value="{{$itemCategory->id}}" {{$item->item_category_id == $itemCategory->id ? 'selected' : '' }}>{{$itemCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="col-form-label">Unit <span class="star">*</span></label>
                            <select name="item_unit_id" class="form-control">
                                <option value="">Select Unit...</option>
                                @foreach($itemUnits as $itemUnit)
                                    <option value="{{$itemUnit->id}}" {{$item->item_unit_id == $itemUnit->id ? 'selected' : '' }}>{{$itemUnit->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label">Descriptions</label>
                            <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{$item->desc}}</textarea>
                            @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                            <div class="col-md-6 float-left">
                                <a class="btn btn-outline-secondary" href="{{route('items.index')}}">Cancel</a>
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

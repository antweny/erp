@extends('layouts.templates.store')
@section('title','Update Item')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h4 class="header-title">Update <strong>{{$item->name}}</strong> item</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('items.index')}}"><i class="fa fa-list"></i> view items</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($item, array('route' => array('items.update', $item->id), 'method' => 'PUT','autocomplete'=>'off')) }}
                        @csrf
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label class="col-form-label">Item Name <span class="star">*</span></label>
                            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{$item->name}}" placeholder="Ex. Ream Paper, Staple Pins" required/>
                            @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
                        </div>
                        <div class="col-md-4">
                            @include('partials.item.categories.dropdown', ['value' => $item->item_category_id])
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            @include('partials.item.units.dropdown', ['value' => $item->item_unit_id])
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label">Quantity <span class="star">*</span> </label>
                            <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{$item->quantity}}" required></input>
                            @error('quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label">Min. Quantity<span class="star">*</span> </label>
                            <input type="number" name="min_quantity" class="form-control @error('min_quantity') is-invalid @enderror" value="{{$item->min_quantity}}" required></input>
                            @error('min_quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
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
                                <a class="btn btn-dark" href="{{route('items.index')}}">Cancel</a>
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

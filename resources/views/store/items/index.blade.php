@extends('layouts.store')
@section('title','Items')
@section('content')

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="float-left">
                            <h4 class="header-title">Items</h4>
                        </div>
                        <div class="float-right">
                            @if(checkPermission('item-create'))
                                <a class="btn btn-primary" href="#newRecord" data-toggle="modal"><i class="fa fa-plus"></i> Add Item</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('alerts._flash')
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm" id="table">
                        <thead class="text-uppercase text-center bg-blue">
                        <tr class="text-white">
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Min Quantity</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Descriptions</th>
                            <th scope="col" >Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td class="text-left">{{$item->name}}</td>
                                <td class="text-center">{{$item->item_category->name}}</td>
                                <td class="text-center">{{$item->item_unit->name}}</td>
                                <td class="text-center">{{$item->min_quantity}}</td>
                                <td class="text-center">{{$item->quantity}}</td>
                                <td class="text-center">{!!$item->status!!}</td>
                                <td class="text-center">{{$item->desc}}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @if(checkPermission('item-update'))
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('items.edit',$item->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if(checkPermission('item-delete'))
                                            <form class="form-delete" method="post" action="{{route('items.destroy',$item->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete {{$item->name}} item?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
                                            </form>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

@if(checkPermission('item-create'))
    <!-- start create new pillar form modal -->
    <div class="modal fade" id="newRecord" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('items.store')}}" class="form-horizontal" role="form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-7">
                                <label class="col-form-label">Item Name <span class="star">*</span></label>
                                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name')}}" placeholder="Ex. Ream Paper, Staple Pins" required/>
                                @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
                            </div>
                            <div class="col-md-5">
                                <label class="col-form-label">Category <span class="star">*</span></label>
                                <select name="item_category_id" class="form-control" required>
                                    <option value="">Select Category...</option>
                                    @foreach($itemCategories as $itemCategory)
                                        <option value="{{$itemCategory->id}}" {{old('item_category_id') == $itemCategory->id ? 'selected' : '' }}>{{$itemCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">

                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label">Measurement</label>
                                <select name="item_unit_id" class="form-control" >
                                    <option value="">Select Unit...</option>
                                    @foreach($itemUnits as $itemUnit)
                                        <option value="{{$itemUnit->id}}" {{old('item_unit_id') == $itemUnit->id ? 'selected' : '' }}>{{$itemUnit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Quantity <span class="star">*</span> </label>
                                <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{old('quantity')}}" required></input>
                                @error('quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Min. Quantity<span class="star">*</span> </label>
                                <input type="number" name="min_quantity" class="form-control @error('min_quantity') is-invalid @enderror" value="{{old('min_quantity')}}" required></input>
                                @error('min_quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label">Descriptions</label>
                                <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{old('desc')}}</textarea>
                                @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn-save">save record</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end create new pillar form modal -->
@endif

@endsection

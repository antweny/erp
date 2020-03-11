@extends('layouts.templates.store')
@section('title','Items List')
@section('content')

        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h4 class="header-title">Items List</h4>
                </div>
                <div class="float-right">
                    @can('item-create')
                        <a class="btn btn-dark mr-4 " href="#import" data-toggle="modal"><i class="fa fa-upload"></i> Import</a>
                        <a class="btn btn-success" href="#newRecord" data-toggle="modal"><i class="fa fa-plus"></i> Add Item</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                @include('alerts._flash')
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm" id="table">
                        <thead class="text-uppercase text-center">
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
                                        @can('item-update')
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('items.edit',$item->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('item-delete')
                                            <form class="form-delete" method="post" action="{{route('items.destroy',$item->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete {{$item->name}} item?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
                                            </form>
                                        @endcan

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

@can('item-create')
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
                            <div class="col-md-12">
                                <label class="col-form-label">Item Name <span class="star">*</span></label>
                                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name')}}" placeholder="Ex. Ream Paper, Staple Pins" required/>
                                @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                @include('partials.item.categories.dropdown',['value' => null])
                            </div>
                            <div class="col-md-6">
                                @include('partials.item.units.dropdown',['value' => null])
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">Quantity <span class="star">*</span> </label>
                                <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{old('quantity')}}" required></input>
                                @error('quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-6">
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
                        <button type="submit" class="btn btn-success" id="btn-save">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


        <!-- start create new permission form modal -->
        <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Items</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('items.import')}}" class="form-horizontal" enctype="multipart/form-data" >
                        @csrf
                        <div class="modal-body">

                            <div class="form-group row">
                                <label for="name" class="col-md-4 control-label">Choose file..</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control @error('imported_file') is-invalid @enderror" name="imported_file" value="{{old('imported_file')}}" required placeholder="name">
                                    @error('imported_file')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" id="btn-save">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            <!-- end create new permission form modal -->
        @endcan

@endsection

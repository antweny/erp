@extends('layouts.templates.store')
@section('title','Item Categories')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">Item Categories</h4>
            </div>
            <div class="float-right">
                @if(checkPermission('itemCategory-create'))
                    <a class="btn btn-success" href="#newRecord" data-toggle="modal"><i class="fa fa-plus"></i> Add Item Category</a>
                @endif
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center">
                        <tr class="text-white">
                            <th scope="col">Name</th>
                            <th scope="col">Descriptions</th>
                            <th scope="col" >Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       @include('partials.item.categories.list')
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if(checkPermission('itemCategory-create'))
    <!-- start create new pillar form modal -->
    <div class="modal fade" id="newRecord" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Item Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('itemCategories.store')}}" class="form-horizontal" role="form" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label class="col-form-label">Item Category Name <span class="star">*</span></label>
                                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " value="{{old('name')}}" placeholder="Ex. Stationary, IT" required/>
                                @if ($errors->has('name'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('name') }}</strong></span>@endif
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Sort Number</label>
                                <input type="number" name="sort" id="sort" class="form-control {{ $errors->has('sort') ? ' is-invalid' : '' }} " value="{{old('sort')}}" placeholder="0, 1, 2" />
                                @if ($errors->has('sort'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('sort') }}</strong></span>@endif
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
    <!-- end create new pillar form modal -->
    @endif


@endsection

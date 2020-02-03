@extends('layouts.admin')
@section('title','Update Item Issued')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h1 class="h4">Update Item Issued</h1>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-info btn-sm text-white" href="{{route('itemIssued.index')}}" title="create"><i class="fa fa-list mr-1"></i> item issued</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($itemIssued, array('route' => array('itemIssued.update', $itemIssued), 'method' => 'PUT')) }}
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">Date Issued <span class="star">*</span> </label>
                                <input type="date" name="date_issued" class="form-control @error('date_issued') is-invalid @enderror" value="{{$itemIssued->date_issued}}" required></input>
                                @error('date_issued')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label" name="title">Item Name <span class="star">*</span></label>
                                <input type="text" name="item_name" class="form-control" value="{{$itemIssued->item->name}}" required readonly></input>
                                <input type="hidden" name="item_id" class="form-control" value="{{$itemIssued->item_id}}"></input></div>
                            </div>
    
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="col-form-label">Quantity <span class="star">*</span> </label>
                                <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{$itemIssued->quantity}}" required></input>
                                <input type="hidden" name="old_quantity" class="form-control @error('old_quantity') is-invalid @enderror" value="{{$itemIssued->quantity}}" required></input>
                                @error('quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
    
                        <div class="form-group row justify-content-center">
                            <div class="col-md-12">
                                <div class="float-left">
                                    <a class="btn btn-outline-secondary" href="{{route('itemIssued.index')}}" title="create">cancel</a>
                                </div>
                                <div class="float-right">
                                    <input type="submit" class="btn btn-primary" value="update record"/>
                                </div>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>


@endsection


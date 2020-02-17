@extends('layouts.admin')
@section('title','Update Item Received')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h1 class="h4">Update Item Received</h1>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-info btn-sm text-white" href="{{route('itemReceived.index')}}" title="create"><i class="fa fa-list mr-1"></i> item received</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($itemReceived, array('route' => array('itemReceived.update', $itemReceived->id), 'method' => 'PUT')) }}
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">Date Received <span class="star">*</span> </label>
                                <input type="date" name="date_received" class="form-control @error('date_received') is-invalid @enderror" value="{{old('date_received',$itemReceived->date_received)}}"></input>
                                @error('date_received')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label" name="title">Item Name <span class="star">*</span></label>
                                <input type="text" name="item_name" class="form-control" value="{{$itemReceived->item->name}}" required readonly></input>
                                <input type="hidden" name="item_id" class="form-control" value="{{$itemReceived->item_id}}"></input>
                                @error('item_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label">Item Descriptions</label>
                                <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="3">{{old('desc',$itemReceived->desc)}}</textarea>
                                @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">Quantity <span class="star">*</span> </label>
                                <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{old('quantity',$itemReceived->quantity)}}" required></input>
                                @error('quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Unit Rate <span class="star">*</span> </label>
                                <input type="number" name="unit_rate" class="form-control @error('unit_rate') is-invalid @enderror" value="{{old('unit_rate',$itemReceived->unit_rate)}}" required></input>
                                @error('unit_rate')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label">Remarks</label>
                                <textarea name="remarks" id="desc" class="form-control @error('remarks') is-invalid @enderror" rows="3">{{old('remarks',$itemReceived->remarks)}}</textarea>
                                @error('remarks')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>


                        <div class="form-group row justify-content-center">
                            <div class="col-md-12">
                                <div class="float-left">
                                    <a class="btn btn-outline-secondary" href="{{route('itemReceived.index')}}" title="create">cancel</a>
                                </div>
                                <div class="float-right">
                                    <input type="submit" class="btn btn-primary" value="Update Record"/>
                                </div>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection


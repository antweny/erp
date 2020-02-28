@extends('layouts.templates.store')
@section('title','Update Item Request')
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h1 class="h4">Issue Item Request</h1>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-warning text-white" href="{{route('itemRequests.index')}}" title="create"><i class="fa fa-list"></i> view item requests</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts._flash')
                    {{ Form::model($itemRequest, array('route' => array('itemRequests.update', $itemRequest->id), 'method' => 'PUT')) }}
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-form-label">Date Request <span class="star">*</span></label>
                                <input type="date" name="date_issued" class="form-control @error('date_issued') is-invalid @enderror" value="{{date_to_mysql($itemRequest->date_issued)}}" required></input>
                                @error('date_issued')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8">
                                <label class="col-form-label" name="title">Item Name <span class="star">*</span></label>
                                <input type="text" name="item_name" class="form-control" value="{{$itemRequest->item->name}}" required readonly></input>
                                <input type="hidden" name="item_id" class="form-control" value="{{$itemRequest->item_id}}"></input>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label" name="title">Quantity Remain</label>
                                <input type="text" name="item_name" class="form-control" value="{{$itemRequest->item->quantity}}" required readonly></input>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label">Required <span class="star">*</span> </label>
                                <input type="number" name="required" class="form-control @error('required') is-invalid @enderror" value="{{old('required',$itemRequest->required)}}" required></input>
                                @error('required')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label">Quantity <span class="star">*</span> </label>
                                <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{$itemRequest->quantity}}" required></input>
                                <input type="hidden" name="old_quantity" class="form-control @error('old_quantity') is-invalid @enderror" value="{{$itemRequest->quantity}}" required></input>
                                @error('quantity')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-form-label">Employee Name<span class="star">*</span> </label>
                                <input type="text" name="employee_name" class="form-control" value="{{$itemRequest->employee->full_name}}" required readonly></input>
                                <input type="hidden" name="employee_id" class="form-control" value="{{$itemRequest->employee_id}}"></input>
                                @error('employee_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label">Descriptions</label>
                                <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{old('desc',$itemRequest->desc)}}</textarea>
                                @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
                            </div>
                        </div>


                        <div class="form-group row justify-content-center">
                            <div class="col-md-12">
                                <div class="float-left">
                                    <a class="btn btn-dark" href="{{route('itemRequests.index')}}" title="create">cancel</a>
                                </div>
                                <div class="float-right">
                                    <input type="submit" class="btn btn-success" value="Issue Item"/>
                                </div>
                            </div>
                        </div>

                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

@endsection


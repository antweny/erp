@extends('layouts.employee')
@section('title','Item Requests')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h4 class="header-title">Store Requests</h4>
            </div>
            <div class="float-right">
                <a class="btn btn-success" href="#newRecord" data-toggle="modal"><i class="fa fa-plus"></i> New Store Request</a>
            </div>
        </div>
        <div class="card-body">
            @include('alerts._flash')
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="table">
                    <thead class="text-uppercase text-center">
                        <tr class="text-white">
                            <th scope="col">Date Request</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Required</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Issued Date</th>
                            <th scope="col">Description</th>
                            <th scope="col" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itemRequests as $itemRequest)
                            <tr>
                                <td class="text-center">{{$itemRequest->created_at}}</td>
                                <td class="text-center">{{$itemRequest->item->name}}</td>
                                <td class="text-center">{{$itemRequest->required}}</td>
                                <td class="text-center">{{$itemRequest->quantity}}</td>
                                <td class="text-center">{!! $itemRequest->item_status!!}</td>
                                <td class="text-center">{{$itemRequest->date_issued}}</td>
                                <td class="text-center">{{ $itemRequest->desc}}</td>
                                <td class="text-center">
                                    @if($itemRequest->status == 'O')
                                    <div class="btn-group">
                                        <a class="btn btn-primary btn-sm mr-2" href="{{route('employee.itemRequests.edit',$itemRequest->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        <form class="form-delete" method="post" action="{{route('employee.itemRequests.destroy',$itemRequest->id)}}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- start create new pillar form modal -->
    <div class="modal fade" id="newRecord" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Store Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{route('employee.itemRequests.store')}}" class="form-horizontal" role="form" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-form-label" name="title">Item Name <span class="star">*</span></label>
                                <select name="item_id" class="form-control @error('date_issued') is-invalid @enderror single-select" required>
                                    <option value="">Select Item...</option>
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}" {{old('item_id')}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('item_id')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="col-form-label">Required <span class="star">*</span> </label>
                                <input type="number" name="required" class="form-control @error('required') is-invalid @enderror" value="{{old('required')}}" required></input>
                                @error('required')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label">Descriptions</label>
                                <textarea name="desc" id="desc" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}" rows="5">{{old('desc')}}</textarea>
                                @if ($errors->has('desc'))<span class="invalid-feedback" role="alert"> <strong>{{ $errors->first('desc') }}</strong></span>@endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="hidden" name="employee_id"  value="{{currentLogged()->id}}" required></input>
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


@endsection

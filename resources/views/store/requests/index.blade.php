@extends('layouts.admin')
@section('title','Item Requests')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Item Requests</h4>
                    </div>
                    <div class="float-right">
                        @if(checkPermission('itemRequest-create'))
                            <a class="btn btn-primary" href="{{route('itemRequests.create')}}" ><i class="fa fa-plus"></i> Request Item</a>
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
                            <th scope="col">Date Issued</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Required</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Request By</th>
                            <th scope="col">Date Request</th>
                            <th scope="col" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($itemRequests as $itemRequest)
                            <tr>
                                <td class="text-center">{{$itemRequest->date_issued}}</td>
                                <td class="text-left">{{$itemRequest->item->name}}</td>
                                <td class="text-center">{{$itemRequest->required}}</td>
                                <td class="text-center">{{$itemRequest->quantity}}</td>
                                <td class="text-center">{!! $itemRequest->item_status!!}</td>
                                <td class="text-center">{{$itemRequest->employee->full_name}}</td>
                                <td class="text-center">{{$itemRequest->created_at}}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @if(checkPermission('itemRequest-update'))
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('itemRequests.edit',$itemRequest->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if(checkPermission('itemRequest-delete'))
                                            <form class="form-delete" method="post" action="{{route('itemRequests.destroy',$itemRequest->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
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

@endsection

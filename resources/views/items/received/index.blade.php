@extends('layouts.admin')
@section('title','Items Received')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Items Received</h4>
                    </div>
                    <div class="float-right">
                        @can('itemReceived-create')
                            <a class="btn btn-primary" href="{{route('itemReceived.create')}}" ><i class="fa fa-plus"></i> Receive Item</a>
                        @endcan
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
                        <th scope="col">Date Received</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Item Desc</th>
                        <th scope="col">Quantity</th>
                        <th scope="col" >Unit</th>
                        <th scope="col" >Rate</th>
                        <th scope="col" >Amount</th>
                        <th scope="col" >Remarks</th>
                        <th scope="col" >Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($itemReceiveds as $itemReceived)
                            <tr>
                                <td class="text-center">{{$itemReceived->date_received}}</td>
                                <td class="text-left">{{$itemReceived->item->name}}</td>
                                <td class="text-left">{{$itemReceived->desc}}</td>
                                <td class="text-center">{{$itemReceived->quantity}}</td>
                                <td class="text-center">{{$itemReceived->desc}}</td>
                                <td class="text-center">{{$itemReceived->unit_rate}}</td>
                                <td class="text-center">{{$itemReceived->amount}}</td>
                                <td class="text-center">{{$itemReceived->remarks}}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @can('itemReceived-update')
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('itemReceived.edit',$itemReceived)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('itemReceived-delete')
                                            <form class="form-delete" method="post" action="{{route('itemReceived.destroy',$itemReceived)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this?')" title="Delete"><i class="fa fa-trash-alt"></i></button>
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


@endsection

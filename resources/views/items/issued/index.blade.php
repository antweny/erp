@extends('layouts.store')
@section('title','Items Issued')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-left">
                        <h4 class="header-title">Items Issued</h4>
                    </div>
                    <div class="float-right">
                        @can('itemIssued-create')
                            <a class="btn btn-primary" href="{{route('itemIssued.create')}}" ><i class="fa fa-plus"></i> Issue Item</a>
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
                        <th scope="col">Date Issued</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Required</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Issued To</th>
                        <th scope="col" >Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($itemIssueds as $itemIssued)
                            <tr>
                                <td class="text-center">{{$itemIssued->date_issued}}</td>
                                <td class="text-left">{{$itemIssued->item->name}}</td>
                                <td class="text-center">{{$itemIssued->required}}</td>
                                <td class="text-center">{{$itemIssued->quantity}}</td>
                                <td class="text-center">{!! $itemIssued->item_status!!}</td>
                                <td class="text-center">{{$itemIssued->employee->full_name}}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        @can('itemIssued-update')
                                            <a class="btn btn-primary btn-sm mr-2" href="{{route('itemIssued.edit',$itemIssued)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                        @endcan
                                        @can('itemIssued-delete')
                                            <form class="form-delete" method="post" action="{{route('itemIssued.destroy',$itemIssued)}}">
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

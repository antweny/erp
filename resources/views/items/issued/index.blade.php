@extends('layouts.admin')
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

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

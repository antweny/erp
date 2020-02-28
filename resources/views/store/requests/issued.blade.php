@extends('layouts.templates.store')
@section('title','Issued Items')
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="float-left">
                <h5>Issued Items</h5>
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
                        <th scope="col">Request By</th>
                        <th scope="col">Date Issued</th>
                        <th scope="col" >Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @include('partials.item.requests.list')
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

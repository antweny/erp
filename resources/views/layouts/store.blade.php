@extends('layouts.master')

@section('body')

        <div class="row">
            <div class="col-md-2">
                <div class="inside-menu card">
                    <div class="card-body">
                        <ul class="list-group list-group-flush p-0">
                            @can('itemCategories-read')
                                <a class="list-group-item" href="{{route('itemCategories.index')}}">
                                    <i class="fa fa-list-alt"></i>
                                    Items Categories
                                </a>
                            @endcan

                            @can('itemUnit-read')
                                <a class="list-group-item" href="{{route('itemUnits.index')}}">
                                    <i class="fab fa-untappd"></i>
                                    Item Units
                                </a>
                            @endcan

                            @can('item-read')
                                <a class="list-group-item" href="{{route('items.index')}}">
                                    <i class="fab fa-product-hunt"></i>
                                    Items
                                </a>
                            @endcan

                            @can('itemReceived-read')
                                <a class="list-group-item" href="{{route('itemReceived.index')}}">
                                    <i class="fa fa-download"></i>
                                    Items Received
                                </a>
                            @endcan

                            @can('itemIssued-read')
                                <a class="list-group-item" href="{{route('itemIssued.index')}}">
                                    <i class="fa fa-upload"></i>
                                    Items Issued
                                </a>
                            @endcan
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                    @yield('content')
            </div>
        </div>

@endsection

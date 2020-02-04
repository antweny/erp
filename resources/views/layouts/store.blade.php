@extends('layouts.master')

@section('body')

        <div class="row">
            <div class="col-md-2">
                <div class="inside-menu card">
                    <div class="card-body">
                        <ul class="list-group list-group-flush p-0">
                            @can('itemCategories-read')
                                <li class="list-group-item">
                                    <a href="{{route('itemCategories.index')}}">
                                        <i class="fa fa-list-alt"></i>
                                        Items Categories
                                    </a>
                                </li>
                            @endcan

                            @can('itemUnit-read')
                                <li class="list-group-item">
                                    <a href="{{route('itemUnits.index')}}">
                                        <i class="fab fa-untappd"></i>
                                        Item Units
                                    </a>
                                </li>
                            @endcan

                            @can('item-read')
                                <li class="list-group-item">
                                    <a  href="{{route('items.index')}}">
                                        <i class="fab fa-product-hunt"></i>
                                        Items
                                    </a>
                                </li>
                            @endcan

                            @can('itemReceived-read')
                                <li class="list-group-item">
                                    <a  href="{{route('itemReceived.index')}}">
                                        <i class="fa fa-download"></i>
                                        Items Received
                                    </a>
                                </li>
                            @endcan

                            @can('itemIssued-read')
                                <li class="list-group-item">
                                    <a  href="{{route('itemIssued.index')}}">
                                        <i class="fa fa-upload"></i>
                                        Items Issued
                                    </a>
                                </li>
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

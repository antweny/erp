@extends('layouts.master')

@section('body')

        <div class="row">
            <div class="col-md-2">
                <div class="inside-menu card">
                    <div class="card-body">
                        <ul class="list-group list-group-flush p-0">
                            <li class="list-group-item">
                                @can('itemCategories-read')
                                    <a href="{{route('itemCategories.index')}}">
                                        <i class="fa fa-list-alt"></i>
                                        Items Categories
                                    </a>
                                @endcan
                            </li>

                            <li class="list-group-item">
                                @can('item-read')
                                    <a  href="{{route('items.index')}}">
                                        <i class="fab fa-product-hunt"></i>
                                        Items
                                    </a>
                                @endcan
                            </li>

                            <li class="list-group-item">
                                @can('itemUnit-read')
                                    <a href="{{route('itemUnits.index')}}">
                                        <i class="fab fa-untappd"></i>
                                        Units
                                    </a>
                                @endcan
                            </li>

                            <li class="list-group-item">
                                @can('itemReceived-read')
                                    <a  href="{{route('itemReceived.index')}}">
                                        <i class="fa fa-download"></i>
                                        Items Received
                                    </a>
                                @endcan
                            </li>

                            <li class="list-group-item">
                                @can('itemIssued-read')
                                    <a  href="{{route('itemIssued.index')}}">
                                        <i class="fa fa-upload"></i>
                                        Items Issued
                                    </a>
                                @endcan
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                    @yield('content')
            </div>
        </div>

@endsection
